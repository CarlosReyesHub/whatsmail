<?php

namespace App\Http\Controllers\ChatBot;

use App\Http\Controllers\Controller;
use App\Models\ChatBot\FineTunnel;
use App\Models\Setting;
use App\Observers\ChatBot\FineTunnelObserver;
use App\Observers\ChatBot\OpenAiServiceObserver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpWord\IOFactory;
use simplehtmldom\HtmlWeb;

class FineTunnelController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Fine Tunnel Ai Controllers
    |--------------------------------------------------------------------------
    */

    protected $fineTunnelObserver;
    protected $openAiServiceObserver;

    public function __construct(
        FineTunnelObserver $fineTunnelObserver,
        OpenAiServiceObserver $openAiServiceObserver
    ) {
        $this->fineTunnelObserver       = $fineTunnelObserver;
        $this->openAiServiceObserver    = $openAiServiceObserver;
    }

    /*
    |--------------------------------------------------------------------------
    | 1. Fine Tunnel Ai List
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $finetunnels   = $this->fineTunnelObserver->getData($request)->get(['id', 'name', 'description', 'fine_tunnel_id', 'method']);
        return view('finetunnel.index', ['page'  => __('page.fine_tunnel.page'), 'breadcumb' => true], compact('finetunnels'));
    }

    /*
    |--------------------------------------------------------------------------
    | 2. Create Page
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        return view('finetunnel.create', ['page' => __('page.fine_tunnel.add'), 'breadcumb' => true]);
    }

    /*
    |--------------------------------------------------------------------------
    | 3. Update Page
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, FineTunnel $fineTunnel)
    {
        return view('finetunnel.update', ['page' => __('page.fine_tunnel.edit'), 'breadcumb' => true], compact('fineTunnel'));
    }

    /*
    |--------------------------------------------------------------------------
    | 4. Create Data
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {

        $this->validate($request, [
            'name'              => 'required',
            'method'            => 'required|in:text,file,website',
            'description'       => 'required_if:method,text',
            'url'               => 'required_if:method,website',
            'file'              => 'required_if:method,file|mimes:docx',
            'option_audio_to_text_ai'   => 'required|in:yes,no',
            'min_audio'         => 'required_if:option_audio_to_text_ai,yes'
        ]);

        $validationCheck = $this->fineTunnelObserver->checkLimit();

        if ($validationCheck == false) {
            return redirect()->back()->with(['gagal'    => __('validation.chatbot_limit')]);
        }

        try {

            DB::beginTransaction();

            $description  = $request->description;

            if ($request->method == 'file') {

                $wordToText         = $this->extractTextFromWorld($request->file('file')->getPathname());

                if ($wordToText == false) {
                    return redirect()->back()->with(['gagal'    => __('validation.finetunnel_read_doc')]);
                }

                $description        = $wordToText;
            }

            if ($request->method == 'website') {
                $url            = $request->input('url');
                $client         = new HtmlWeb();
                $html           = $client->load($url);
                $description    = $html->find('body', 0)->plaintext;
            }

            $fineTunnel   = $this->fineTunnelObserver->createData($request, $description);
            $this->fineTunnelObserver->createDetails($request, $fineTunnel);

            if ($fineTunnel->details->count() > 0) {

                $fileName       = strtolower(preg_replace("/[^0-9a-zA-Z]/", "-", $fineTunnel->name));

                $jsonlFilePath  = public_path('uploads/finetunnels/' . $fileName . '.jsonl');

                if (!file_exists(dirname($jsonlFilePath))) {
                    mkdir(dirname($jsonlFilePath), 0755, true);
                }


                $file           = fopen($jsonlFilePath, 'w');

                foreach ($fineTunnel->details as $detail) {
                    $jsonLine = json_encode([
                        'prompt'        => $detail->command,
                        'completion'    => $detail->answer,
                    ]) . PHP_EOL;
                    fwrite($file, $jsonLine);
                }

                fclose($file);

                $fineTunnel->update([
                    'filejson'      => 'uploads/finetunnels/' . $fileName . '.jsonl'
                ]);
            }


            DB::commit();

            return redirect()->route('finetunnel')->with(['flash'    => __('general.success_add_data')]);
        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->back()->with(['gagal'    => $e->getMessage()]);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | 5. Update Data
    |--------------------------------------------------------------------------
    */

    public function edit(Request $request, FineTunnel $fineTunnel)
    {
        $this->validate($request, [
            'name'              => 'required',
            'method'            => 'required|in:text,file,website',
            'description'       => 'required_if:method,text',
            'url'               => 'required_if:method,website',
            'file'              => 'mimes:docx',
            'option_audio_to_text_ai'   => 'required|in:yes,no',
            'min_audio'         => 'required_if:option_audio_to_text_ai,yes'
        ]);

        try {

            DB::beginTransaction();


            $description  = $fineTunnel->method == 'file' || $fineTunnel->method == 'website' ? $fineTunnel->description : $request->description;

            if ($request->method == 'text') {
                $description    = $request->description;
            }

            if ($request->method == 'file') {

                if ($request->file('file')) {
                    $wordToText         = $this->extractTextFromWorld($request->file('file')->getPathname());

                    if ($wordToText == false) {
                        return redirect()->back()->with(['gagal'    => __('validation.finetunnel_read_doc')]);
                    }

                    $description        = $wordToText;
                }
            }

            if ($request->method == 'website') {
                $url            = $request->input('url');
                $client         = new HtmlWeb();
                $html           = $client->load($url);
                $description    = $html->find('body', 0)->plaintext;
            }

            $this->fineTunnelObserver->updateData($request, $fineTunnel, $description);
            $this->fineTunnelObserver->createDetails($request, $fineTunnel);

            if ($fineTunnel->details->count() > 0) {
                $fileName       = strtolower(preg_replace("/[^0-9a-zA-Z]/", "-", $request->name));
                $jsonlFilePath  = public_path('uploads/finetunnels/' . $fileName . '.jsonl');

                if (!file_exists(dirname($jsonlFilePath))) {
                    mkdir(dirname($jsonlFilePath), 0755, true);
                }

                $file           = fopen($jsonlFilePath, 'w');

                foreach ($fineTunnel->details as $detail) {
                    $jsonLine = json_encode([
                        'prompt'        => $detail->command,
                        'completion'    => $detail->answer,
                    ]) . PHP_EOL;
                    fwrite($file, $jsonLine);
                }

                fclose($file);

                $fineTunnel->update([
                    'filejson'      => 'uploads/finetunnels/' . $fileName . '.jsonl'
                ]);
            }

            DB::commit();

            return redirect()->route('finetunnel')->with(['flash'    => __('general.success_update')]);
        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->back()->with(['gagal'    => $e->getMessage()]);
        }
    }


    /*
    |--------------------------------------------------------------------------
    | 6. Delete Data
    |--------------------------------------------------------------------------
    */

    public function delete(FineTunnel $fineTunnel)
    {
        $this->unlinkFile($fineTunnel->filejson);

        $settings = Setting::first(['open_ai_key']);
        if ($fineTunnel->fine_tunnel_id != null) {
            $response = $this->openAiServiceObserver->getFileTun($fineTunnel, $settings->open_ai_key);

            if ($response->status() == 200) {
                $response = $this->openAiServiceObserver->deleteFileTun($fineTunnel, $settings->open_ai_key);
            }
        }

        $this->fineTunnelObserver->deleteData($fineTunnel);

        return redirect()->back()->with(['flash'    => __('general.success_deleted')]);
    }


    /*
    |--------------------------------------------------------------------------
    | 7. Upload DataSet To Open Ai
    |--------------------------------------------------------------------------
    */

    public function uploadDataSet(FineTunnel $fineTunnel)
    {
        $settings = Setting::first(['open_ai_key']);

        // Check Api key
        if ($settings->open_ai_key == null) {
            return redirect()->back()->with(['gagal'    => __('finetunnel.please_set_open_ai_api_key')]);
        }

        // Check File Tunnel Ready or Not and Delete old file
        if ($fineTunnel->fine_tunnel_id != null) {
            $response = $this->openAiServiceObserver->getFileTun($fineTunnel, $settings->open_ai_key);

            if ($response->status() == 200) {
                $response = $this->openAiServiceObserver->deleteFileTun($fineTunnel, $settings->open_ai_key);
                if ($response->status() != 200) {
                    $responseBody   = json_decode($response->body());
                    return redirect()->back()->with(['gagal'    => $responseBody->error->message]);
                }
            }
        }

        // Upload New FineTunnel
        $fileJson   = explode("/", $fineTunnel->filejson);
        $response   = $this->openAiServiceObserver->uploadFileTune($fineTunnel, $settings->open_ai_key, $fileJson[2]);

        if ($response->status() == 200) {
            $responseBody   = json_decode($response->body());
            $fineTunnel->update([
                'fine_tunnel_id'    => $responseBody->id,
                'status'            => 'processed'
            ]);
            return redirect()->back()->with(['flash'    => __('finetunnel.success_upload_fine_tunnel')]);
        } else {
            $responseBody   = json_decode($response->body());
            return redirect()->back()->with(['gagal'    => $responseBody->error->message]);
        }
    }

    function extractTextFromWorld($filePath)
    {
        try {
            $phpWord = IOFactory::load($filePath);
            $text = '';

            foreach ($phpWord->getSections() as $section) {
                $elements = $section->getElements();
                foreach ($elements as $element) {
                    if (method_exists($element, 'getText')) {
                        $text .= $element->getText() . "\n";
                    }
                }
            }

            return $text;
        } catch (\Exception $e) {
            return false;
        }
    }
}
