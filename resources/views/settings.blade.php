@extends('layouts.app')

@section('styles')
<link href="{{asset('assets/libs/select2/select2.min.css')}}" rel="stylesheet">
@endsection

@section('content')
<!-- Start::app-content -->
<div class="row">
    <div class="col-lg-12">
        <x-validation-component></x-validation-component>
        <form action="<?= route('setting.change'); ?>" method="POST" class="card custom-card">
            @csrf
            <div class="card-header">
                <div class="card-title">
                    {{__('master.configuration.update_configuration')}}
                </div>

            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 border-bottom mb-4">
                        <blockquote class="blockquote mb-2">
                            <h4>A. {{__('master.configuration.general')}}</h4>
                        </blockquote>
                    </div>
                    <div class="col-lg-6 col-sm-12 mt-3">
                        <label class="form-label">{{__('master.configuration.timezone')}}</label>
                        <select class="form-control timezone" name="timezone">
                            <option value="">{{__('master.configuration.choose_timezone')}}</option>
                            @foreach (timezone() as $t => $timezone)
                            <option value="<?= $timezone; ?>" @if($timezone==$setting->timezone) selected @endif >{{$timezone}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-lg-6 col-sm-12 mt-3">
                        <label class="form-label">{{__('master.configuration.country_phone_code')}}</label>
                        <select class="form-control phonecode" name="phone_country_code">
                            <option value="">{{__('master.configuration.choose_country_phone_code')}}</option>
                            <option value="1" @if($setting->phone_country_code == '1') selected @endif>United States (+1)</option>
                            <option value="7" @if($setting->phone_country_code == '7') selected @endif>Russia (+7)</option>
                            <option value="20" @if($setting->phone_country_code == '20') selected @endif>Egypt (+20)</option>
                            <option value="27" @if($setting->phone_country_code == '27') selected @endif>South Africa (+27)</option>
                            <option value="30" @if($setting->phone_country_code == '30') selected @endif>Greece (+30)</option>
                            <option value="31" @if($setting->phone_country_code == '31') selected @endif>Netherlands (+31)</option>
                            <option value="32" @if($setting->phone_country_code == '32') selected @endif>Belgium (+32)</option>
                            <option value="33" @if($setting->phone_country_code == '33') selected @endif>France (+33)</option>
                            <option value="34" @if($setting->phone_country_code == '34') selected @endif>Spain (+34)</option>
                            <option value="36" @if($setting->phone_country_code == '36') selected @endif>Hungary (+36)</option>
                            <option value="39" @if($setting->phone_country_code == '39') selected @endif>Italy (+39)</option>
                            <option value="40" @if($setting->phone_country_code == '40') selected @endif>Romania (+40)</option>
                            <option value="41" @if($setting->phone_country_code == '41') selected @endif>Switzerland (+41)</option>
                            <option value="43" @if($setting->phone_country_code == '43') selected @endif>Austria (+43)</option>
                            <option value="44" @if($setting->phone_country_code == '44') selected @endif>United Kingdom (+44)</option>
                            <option value="45" @if($setting->phone_country_code == '45') selected @endif>Denmark (+45)</option>
                            <option value="46" @if($setting->phone_country_code == '46') selected @endif>Sweden (+46)</option>
                            <option value="47" @if($setting->phone_country_code == '47') selected @endif>Norway (+47)</option>
                            <option value="48" @if($setting->phone_country_code == '48') selected @endif>Poland (+48)</option>
                            <option value="49" @if($setting->phone_country_code == '49') selected @endif>Germany (+49)</option>
                            <option value="51" @if($setting->phone_country_code == '51') selected @endif>Peru (+51)</option>
                            <option value="52" @if($setting->phone_country_code == '52') selected @endif>Mexico (+52)</option>
                            <option value="53" @if($setting->phone_country_code == '53') selected @endif>Cuba (+53)</option>
                            <option value="54" @if($setting->phone_country_code == '54') selected @endif>Argentina (+54)</option>
                            <option value="55" @if($setting->phone_country_code == '55') selected @endif>Brazil (+55)</option>
                            <option value="56" @if($setting->phone_country_code == '56') selected @endif>Chile (+56)</option>
                            <option value="57" @if($setting->phone_country_code == '57') selected @endif>Colombia (+57)</option>
                            <option value="58" @if($setting->phone_country_code == '58') selected @endif>Venezuela (+58)</option>
                            <option value="60" @if($setting->phone_country_code == '60') selected @endif>Malaysia (+60)</option>
                            <option value="61" @if($setting->phone_country_code == '61') selected @endif>Australia (+61)</option>
                            <option value="62" @if($setting->phone_country_code == '62') selected @endif>Indonesia (+62)</option>
                            <option value="63" @if($setting->phone_country_code == '63') selected @endif>Philippines (+63)</option>
                            <option value="64" @if($setting->phone_country_code == '64') selected @endif>New Zealand (+64)</option>
                            <option value="65" @if($setting->phone_country_code == '65') selected @endif>Singapore (+65)</option>
                            <option value="66" @if($setting->phone_country_code == '66') selected @endif>Thailand (+66)</option>
                            <option value="81" @if($setting->phone_country_code == '81') selected @endif>Japan (+81)</option>
                            <option value="82" @if($setting->phone_country_code == '82') selected @endif>South Korea (+82)</option>
                            <option value="84" @if($setting->phone_country_code == '84') selected @endif>Vietnam (+84)</option>
                            <option value="86" @if($setting->phone_country_code == '86') selected @endif>China (+86)</option>
                            <option value="90" @if($setting->phone_country_code == '90') selected @endif>Turkey (+90)</option>
                            <option value="91" @if($setting->phone_country_code == '91') selected @endif>India (+91)</option>
                            <option value="92" @if($setting->phone_country_code == '92') selected @endif>Pakistan (+92)</option>
                            <option value="93" @if($setting->phone_country_code == '93') selected @endif>Afghanistan (+93)</option>
                            <option value="94" @if($setting->phone_country_code == '94') selected @endif>Sri Lanka (+94)</option>
                            <option value="95" @if($setting->phone_country_code == '95') selected @endif>Myanmar (+95)</option>
                            <option value="98" @if($setting->phone_country_code == '98') selected @endif>Iran (+98)</option>
                            <option value="212" @if($setting->phone_country_code == '212') selected @endif>Morocco (+212)</option>
                            <option value="213" @if($setting->phone_country_code == '213') selected @endif>Algeria (+213)</option>
                            <option value="216" @if($setting->phone_country_code == '216') selected @endif>Tunisia (+216)</option>
                            <option value="218" @if($setting->phone_country_code == '218') selected @endif>Libya (+218)</option>
                            <option value="220" @if($setting->phone_country_code == '220') selected @endif>The Gambia (+220)</option>
                            <option value="221" @if($setting->phone_country_code == '221') selected @endif>Senegal (+221)</option>
                            <option value="222" @if($setting->phone_country_code == '222') selected @endif>Mauritania (+222)</option>
                            <option value="223" @if($setting->phone_country_code == '223') selected @endif>Mali (+223)</option>
                            <option value="224" @if($setting->phone_country_code == '224') selected @endif>Guinea (+224)</option>
                            <option value="225" @if($setting->phone_country_code == '225') selected @endif>Côte d'Ivoire (+225)</option>
                            <option value="226" @if($setting->phone_country_code == '226') selected @endif>Burkina Faso (+226)</option>
                            <option value="227" @if($setting->phone_country_code == '227') selected @endif>Niger (+227)</option>
                            <option value="228" @if($setting->phone_country_code == '228') selected @endif>Togo (+228)</option>
                            <option value="229" @if($setting->phone_country_code == '229') selected @endif>Benin (+229)</option>
                            <option value="230" @if($setting->phone_country_code == '230') selected @endif>Mauritius (+230)</option>
                            <option value="231" @if($setting->phone_country_code == '231') selected @endif>Liberia (+231)</option>
                            <option value="232" @if($setting->phone_country_code == '232') selected @endif>Sierra Leone (+232)</option>
                            <option value="233" @if($setting->phone_country_code == '233') selected @endif>Ghana (+233)</option>
                            <option value="234" @if($setting->phone_country_code == '234') selected @endif>Nigeria (+234)</option>
                            <option value="235" @if($setting->phone_country_code == '235') selected @endif>Chad (+235)</option>
                            <option value="236" @if($setting->phone_country_code == '236') selected @endif>Central African Republic (+236)</option>
                            <option value="237" @if($setting->phone_country_code == '237') selected @endif>Cameroon (+237)</option>
                            <option value="238" @if($setting->phone_country_code == '238') selected @endif>Cape Verde (+238)</option>
                            <option value="239" @if($setting->phone_country_code == '239') selected @endif>São Tomé and Príncipe (+239)</option>
                            <option value="240" @if($setting->phone_country_code == '240') selected @endif>Equatorial Guinea (+240)</option>
                            <option value="241" @if($setting->phone_country_code == '241') selected @endif>Gabon (+241)</option>
                            <option value="242" @if($setting->phone_country_code == '242') selected @endif>Congo (+242)</option>
                            <option value="243" @if($setting->phone_country_code == '243') selected @endif>Democratic Republic of the Congo (+243)</option>
                            <option value="244" @if($setting->phone_country_code == '244') selected @endif>Angola (+244)</option>
                            <option value="245" @if($setting->phone_country_code == '245') selected @endif>Guinea-Bissau (+245)</option>
                            <option value="246" @if($setting->phone_country_code == '246') selected @endif>Ascension Island (+246)</option>
                            <option value="247" @if($setting->phone_country_code == '247') selected @endif>Saint Helena (+247)</option>
                            <option value="248" @if($setting->phone_country_code == '248') selected @endif>Seychelles (+248)</option>
                            <option value="249" @if($setting->phone_country_code == '249') selected @endif>Sudan (+249)</option>
                            <option value="250" @if($setting->phone_country_code == '250') selected @endif>Rwanda (+250)</option>
                            <option value="251" @if($setting->phone_country_code == '251') selected @endif>Ethiopia (+251)</option>
                            <option value="252" @if($setting->phone_country_code == '252') selected @endif>Somalia (+252)</option>
                            <option value="253" @if($setting->phone_country_code == '253') selected @endif>Djibouti (+253)</option>
                            <option value="254" @if($setting->phone_country_code == '254') selected @endif>Kenya (+254)</option>
                            <option value="255" @if($setting->phone_country_code == '255') selected @endif>Tanzania (+255)</option>
                            <option value="256" @if($setting->phone_country_code == '256') selected @endif>Uganda (+256)</option>
                            <option value="257" @if($setting->phone_country_code == '257') selected @endif>Burundi (+257)</option>
                            <option value="258" @if($setting->phone_country_code == '258') selected @endif>Mozambique (+258)</option>
                            <option value="260" @if($setting->phone_country_code == '260') selected @endif>Zambia (+260)</option>
                            <option value="261" @if($setting->phone_country_code == '261') selected @endif>Madagascar (+261)</option>
                            <option value="262" @if($setting->phone_country_code == '262') selected @endif>Réunion (+262)</option>
                            <option value="263" @if($setting->phone_country_code == '263') selected @endif>Zimbabwe (+263)</option>
                            <option value="264" @if($setting->phone_country_code == '264') selected @endif>Namibia (+264)</option>
                            <option value="265" @if($setting->phone_country_code == '265') selected @endif>Malawi (+265)</option>
                            <option value="266" @if($setting->phone_country_code == '266') selected @endif>Lesotho (+266)</option>
                            <option value="267" @if($setting->phone_country_code == '267') selected @endif>Botswana (+267)</option>
                            <option value="268" @if($setting->phone_country_code == '268') selected @endif>Eswatini (+268)</option>
                            <option value="269" @if($setting->phone_country_code == '269') selected @endif>Comoros (+269)</option>
                            <option value="290" @if($setting->phone_country_code == '290') selected @endif>Saint Helena (+290)</option>
                            <option value="291" @if($setting->phone_country_code == '291') selected @endif>Eritrea (+291)</option>
                            <option value="297" @if($setting->phone_country_code == '297') selected @endif>Aruba (+297)</option>
                            <option value="298" @if($setting->phone_country_code == '298') selected @endif>Faroe Islands (+298)</option>
                            <option value="299" @if($setting->phone_country_code == '299') selected @endif>Greenland (+299)</option>
                            <option value="350" @if($setting->phone_country_code == '350') selected @endif>Gibraltar (+350)</option>
                            <option value="351" @if($setting->phone_country_code == '351') selected @endif>Portugal (+351)</option>
                            <option value="352" @if($setting->phone_country_code == '352') selected @endif>Luxembourg (+352)</option>
                            <option value="353" @if($setting->phone_country_code == '353') selected @endif>Ireland (+353)</option>
                            <option value="354" @if($setting->phone_country_code == '354') selected @endif>Iceland (+354)</option>
                            <option value="355" @if($setting->phone_country_code == '355') selected @endif>Albania (+355)</option>
                            <option value="356" @if($setting->phone_country_code == '356') selected @endif>Malta (+356)</option>
                            <option value="357" @if($setting->phone_country_code == '357') selected @endif>Cyprus (+357)</option>
                            <option value="358" @if($setting->phone_country_code == '358') selected @endif>Finland (+358)</option>
                            <option value="359" @if($setting->phone_country_code == '359') selected @endif>Bulgaria (+359)</option>
                            <option value="370" @if($setting->phone_country_code == '370') selected @endif>Lithuania (+370)</option>
                            <option value="371" @if($setting->phone_country_code == '371') selected @endif>Latvia (+371)</option>
                            <option value="372" @if($setting->phone_country_code == '372') selected @endif>Estonia (+372)</option>
                            <option value="373" @if($setting->phone_country_code == '373') selected @endif>Moldova (+373)</option>
                            <option value="374" @if($setting->phone_country_code == '374') selected @endif>Armenia (+374)</option>
                            <option value="375" @if($setting->phone_country_code == '375') selected @endif>Belarus (+375)</option>
                            <option value="376" @if($setting->phone_country_code == '376') selected @endif>Andorra (+376)</option>
                            <option value="377" @if($setting->phone_country_code == '377') selected @endif>Monaco (+377)</option>
                            <option value="378" @if($setting->phone_country_code == '378') selected @endif>San Marino (+378)</option>
                            <option value="379" @if($setting->phone_country_code == '379') selected @endif>Vatican City (+379)</option>
                            <option value="380" @if($setting->phone_country_code == '380') selected @endif>Ukraine (+380)</option>
                            <option value="381" @if($setting->phone_country_code == '381') selected @endif>Serbia (+381)</option>
                            <option value="382" @if($setting->phone_country_code == '382') selected @endif>Montenegro (+382)</option>
                            <option value="383" @if($setting->phone_country_code == '383') selected @endif>Kosovo (+383)</option>
                            <option value="385" @if($setting->phone_country_code == '385') selected @endif>Croatia (+385)</option>
                            <option value="386" @if($setting->phone_country_code == '386') selected @endif>Slovenia (+386)</option>
                            <option value="387" @if($setting->phone_country_code == '387') selected @endif>Bosnia and Herzegovina (+387)</option>
                            <option value="388" @if($setting->phone_country_code == '388') selected @endif>Yugoslavia (+388)</option>
                            <option value="389" @if($setting->phone_country_code == '389') selected @endif>North Macedonia (+389)</option>
                            <option value="420" @if($setting->phone_country_code == '420') selected @endif>Czech Republic (+420)</option>
                            <option value="421" @if($setting->phone_country_code == '421') selected @endif>Slovakia (+421)</option>
                            <option value="423" @if($setting->phone_country_code == '423') selected @endif>Liechtenstein (+423)</option>
                            <option value="500" @if($setting->phone_country_code == '500') selected @endif>Falkland Islands (+500)</option>
                            <option value="501" @if($setting->phone_country_code == '501') selected @endif>Belize (+501)</option>
                            <option value="502" @if($setting->phone_country_code == '502') selected @endif>Guatemala (+502)</option>
                            <option value="503" @if($setting->phone_country_code == '503') selected @endif>El Salvador (+503)</option>
                            <option value="504" @if($setting->phone_country_code == '504') selected @endif>Honduras (+504)</option>
                            <option value="505" @if($setting->phone_country_code == '505') selected @endif>Nicaragua (+505)</option>
                            <option value="506" @if($setting->phone_country_code == '506') selected @endif>Costa Rica (+506)</option>
                            <option value="507" @if($setting->phone_country_code == '507') selected @endif>Panama (+507)</option>
                            <option value="508" @if($setting->phone_country_code == '508') selected @endif>Saint Pierre and Miquelon (+508)</option>
                            <option value="509" @if($setting->phone_country_code == '509') selected @endif>Haiti (+509)</option>
                            <option value="590" @if($setting->phone_country_code == '590') selected @endif>Guadeloupe (+590)</option>
                            <option value="591" @if($setting->phone_country_code == '591') selected @endif>Bolivia (+591)</option>
                            <option value="592" @if($setting->phone_country_code == '592') selected @endif>Guyana (+592)</option>
                            <option value="593" @if($setting->phone_country_code == '593') selected @endif>Ecuador (+593)</option>
                            <option value="594" @if($setting->phone_country_code == '594') selected @endif>French Guiana (+594)</option>
                            <option value="595" @if($setting->phone_country_code == '595') selected @endif>Paraguay (+595)</option>
                            <option value="596" @if($setting->phone_country_code == '596') selected @endif>Martinique (+596)</option>
                            <option value="597" @if($setting->phone_country_code == '597') selected @endif>Suriname (+597)</option>
                            <option value="598" @if($setting->phone_country_code == '598') selected @endif>Uruguay (+598)</option>
                            <option value="599" @if($setting->phone_country_code == '599') selected @endif>Curaçao (+599)</option>
                            <option value="670" @if($setting->phone_country_code == '670') selected @endif>East Timor (+670)</option>
                            <option value="672" @if($setting->phone_country_code == '672') selected @endif>Australian External Territories (+672)</option>
                            <option value="673" @if($setting->phone_country_code == '673') selected @endif>Brunei (+673)</option>
                            <option value="674" @if($setting->phone_country_code == '674') selected @endif>Nauru (+674)</option>
                            <option value="675" @if($setting->phone_country_code == '675') selected @endif>Papua New Guinea (+675)</option>
                            <option value="676" @if($setting->phone_country_code == '676') selected @endif>Tonga (+676)</option>
                            <option value="677" @if($setting->phone_country_code == '677') selected @endif>Solomon Islands (+677)</option>
                            <option value="678" @if($setting->phone_country_code == '678') selected @endif>Vanuatu (+678)</option>
                            <option value="679" @if($setting->phone_country_code == '679') selected @endif>Fiji (+679)</option>
                            <option value="680" @if($setting->phone_country_code == '680') selected @endif>Palau (+680)</option>
                            <option value="681" @if($setting->phone_country_code == '681') selected @endif>Wallis and Futuna (+681)</option>
                            <option value="682" @if($setting->phone_country_code == '682') selected @endif>Cook Islands (+682)</option>
                            <option value="683" @if($setting->phone_country_code == '683') selected @endif>Niue (+683)</option>
                            <option value="684" @if($setting->phone_country_code == '684') selected @endif>American Samoa (+684)</option>
                            <option value="685" @if($setting->phone_country_code == '685') selected @endif>Samoa (+685)</option>
                            <option value="686" @if($setting->phone_country_code == '686') selected @endif>Tuvalu (+686)</option>
                            <option value="687" @if($setting->phone_country_code == '687') selected @endif>New Caledonia (+687)</option>
                            <option value="688" @if($setting->phone_country_code == '688') selected @endif>Tuvalu (+688)</option>
                            <option value="689" @if($setting->phone_country_code == '689') selected @endif>French Polynesia (+689)</option>
                            <option value="690" @if($setting->phone_country_code == '690') selected @endif>Tokelau (+690)</option>
                            <option value="691" @if($setting->phone_country_code == '691') selected @endif>Micronesia (+691)</option>
                            <option value="692" @if($setting->phone_country_code == '692') selected @endif>Marshall Islands (+692)</option>
                            <option value="693" @if($setting->phone_country_code == '693') selected @endif>Palau (+693)</option>
                            <option value="850" @if($setting->phone_country_code == '850') selected @endif>North Korea (+850)</option>
                            <option value="852" @if($setting->phone_country_code == '852') selected @endif>Hong Kong (+852)</option>
                            <option value="853" @if($setting->phone_country_code == '853') selected @endif>Macau (+853)</option>
                            <option value="855" @if($setting->phone_country_code == '855') selected @endif>Cambodia (+855)</option>
                            <option value="856" @if($setting->phone_country_code == '856') selected @endif>Laos (+856)</option>
                            <option value="880" @if($setting->phone_country_code == '880') selected @endif>Bangladesh (+880)</option>
                            <option value="881" @if($setting->phone_country_code == '881') selected @endif>Global Mobile Satellite System (+881)</option>
                            <option value="882" @if($setting->phone_country_code == '882') selected @endif>Global Mobile Satellite System (+882)</option>
                            <option value="883" @if($setting->phone_country_code == '883') selected @endif>Global Mobile Satellite System (+883)</option>
                            <option value="886" @if($setting->phone_country_code == '886') selected @endif>Taiwan (+886)</option>
                            <option value="888" @if($setting->phone_country_code == '888') selected @endif>Global Mobile Satellite System (+888)</option>

                        </select>
                    </div>

                    <div class="col-lg-6 col-sm-12 mt-3">
                        <label class="form-label">{{__('master.configuration.default_lang')}}</label>
                        <select class="form-control lang" name="default_lang">
                            <option value="">{{__('master.configuration.choose_lang')}}</option>
                            <option value="id" @if('id'==$setting->default_lang) selected @endif>{{__('sidebar.indonesia')}} </option>
                            <option value="en" @if('en'==$setting->default_lang) selected @endif>{{__('sidebar.english')}}</option>
                            <option value="ja" @if('ja'==$setting->default_lang) selected @endif>{{__('sidebar.japan')}}</option>
                            <option value="ar" @if('ar'==$setting->default_lang) selected @endif>{{__('sidebar.arab')}}</option>
                            <option value="nl" @if('nl'==$setting->default_lang) selected @endif>{{__('sidebar.dutch')}}</option>
                            <option value="pt" @if('pt'==$setting->default_lang) selected @endif>{{__('sidebar.portugal')}}</option>
                        </select>
                    </div>

                    <div class="col-lg-6 col-sm-12 mt-3">
                        <label class="form-label">{{__('setting.local_api_key')}}</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control apikeylocal" readonly value="<?= $setting->local_api_key; ?>">
                            <button class="btn btn-primary" type="button" id="generateApiKey">
                                <i class="bx bx-refresh text-white"></i>
                            </button>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12 mt-3">
                        <label class="form-label">{{__('setting.device_id_api_usage')}}</label>
                        <select class="form-control lang" name="api_device_use" required>
                            <option value="">{{__('general.choose')}}</option>
                            <option value="required" @if('required'==$setting->api_device_use) selected @endif>{{__('setting.must_include')}} </option>
                            <option value="optional" @if('optional'==$setting->api_device_use) selected @endif>{{__('general.optional')}}</option>
                        </select>
                    </div>

                    <div class="col-12 border-bottom mb-4 mt-6">
                        <blockquote class="blockquote mb-2">
                            <h4>B. {{__('setting.ai_usage_setting')}}</h4>
                        </blockquote>
                    </div>

                    <div class="col-lg-6 col-sm-12 mt-3">
                        <label class="form-label">{{__('setting.use_of_ai')}}</label>
                        <select class="form-control lang" name="ai_option">
                            <option value="">{{__('general.choose')}}</option>
                            <option value="chatgpt" @if('chatgpt'==$setting->ai_option) selected @endif>OpenAi </option>
                            <option value="gemini" @if('gemini'==$setting->ai_option) selected @endif>Gemini</option>
                        </select>
                    </div>
                    <div class="col-lg-6 col-sm-12 mt-3">
                        <label class="form-label">{{__('setting.api_key_ai')}}</label>
                        <input class="form-control" name="open_ai_key" value="<?= $setting->open_ai_key; ?>" type="text">
                    </div>
                    <div class="col-lg-6 col-sm-12 mt-3">
                        <label class="form-label">{{__('setting.google_text_audio')}}</label>
                        <input class="form-control" name="google_text_to_audio" value="<?= $setting->google_text_to_audio; ?>" type="text">
                        <small>{{__('setting.text_to_audio_desc')}}</small>
                    </div>

                    <div class="col-12 border-bottom mb-4 mt-6">
                        <blockquote class="blockquote mb-2">
                            <h4>C. {{__('master.configuration.google_map')}}</h4>
                        </blockquote>
                    </div>
                    <div class="col-lg-6 col-sm-12 mt-3">
                        <label class="form-label">{{__('master.configuration.google_map_api_key')}}</label>
                        <input class="form-control" name="gmap_key" value="<?= $setting->gmap_key; ?>" type="text">
                    </div>
                    <div class="col-lg-6 col-sm-12 mt-3">
                        <label class="form-label">{{__('master.configuration.phone_scrapp')}}</label>
                        <select class="form-control" name="scrapp_phone">
                            <option value="protect_double" @if($setting->scrapp_phone == 'protect_double') selected @endif >{{__('general.no')}}</option>
                            <option value="no_protect" @if($setting->scrapp_phone == 'no_protect') selected @endif>{{__('general.yes')}}</option>
                        </select>
                    </div>
                    <div class="col-lg-6 col-sm-12 mt-3">
                        <label class="form-label">{{__('master.configuration.just_scrapp_whatsapp')}}</label>
                        <select class="form-control" name="scrapp_phone_whatsapp">
                            <option value="must_whatsapp" @if($setting->scrapp_phone == 'must_whatsapp') selected @endif >{{__('master.configuration.yes_scrapp')}}</option>
                            <option value="all" @if($setting->scrapp_phone == 'all') selected @endif>{{__('master.configuration.no_scrapp')}}</option>
                        </select>
                    </div>

                </div>
                <div class="row mt-6">
                    <div class="col-12 border-bottom mb-4">
                        <blockquote class="blockquote mb-2">
                            <h4>D. {{__('master.configuration.whatsapp_gateway')}}</h4>
                        </blockquote>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <label class="form-label">{{__('master.configuration.method_sent')}}</label>
                        <select class="form-control" name="whatsapp_sender_notif">
                            <option value="sequence" @if($setting->whatsapp_sender_notif == 'sequence') selected @endif >{{__('master.configuration.sequence')}}</option>
                            <option value="spin" @if($setting->whatsapp_sender_notif == 'spin') selected @endif>Spin</option>
                            <option value="random" @if($setting->whatsapp_sender_notif == 'random') selected @endif>Random</option>
                        </select>
                    </div>
                </div>
                <div class="row mt-6">
                    <div class="col-12 border-bottom mb-4">
                        <blockquote class="blockquote mb-2">
                            <h4>E. SMTP Email</h4>
                        </blockquote>
                    </div>
                    <div class="col-lg-4 col-sm-12">
                        <label class="form-label">Mail Encrypt</label>
                        <input class="form-control" name="mail_encryption" value="<?= $setting->mail_encryption; ?>" type="text">
                    </div>
                    <div class="col-lg-4 col-sm-12">
                        <label class="form-label">Mail Host</label>
                        <input class="form-control" name="mail_host" value="<?= $setting->mail_host; ?>" type="text">
                    </div>
                    <div class="col-lg-4 col-sm-12">
                        <label class="form-label">Mail Port</label>
                        <input class="form-control" name="mail_port" value="<?= $setting->mail_port; ?>" type="text">
                    </div>

                    <div class="col-lg-4 col-sm-12 mt-3">
                        <label class="form-label">Mail Username</label>
                        <input class="form-control" name="mail_username" value="<?= $setting->mail_username; ?>" type="text">
                    </div>
                    <div class="col-lg-4 col-sm-12 mt-3">
                        <label class="form-label">Mail Password</label>
                        <input class="form-control" name="mail_password" value="<?= $setting->mail_password; ?>" type="text">
                    </div>
                    <div class="col-lg-4 col-sm-12 mt-3">
                        <label class="form-label">Mail From Address</label>
                        <input class="form-control" name="mail_from_address" value="<?= $setting->mail_from_address; ?>" type="text">
                    </div>
                    <div class="col-lg-4 col-sm-12 mt-3">
                        <label class="form-label">Mail From Name</label>
                        <input class="form-control" name="mail_from_name" value="<?= $setting->mail_from_name; ?>" type="text">
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-end">
                <button type="submit" class="btn btn-primary"><i class="ti ti-device-floppy fs-16 me-1"></i>{{__('general.save_change')}}</button>
            </div>
        </form>
    </div>
</div>
<!-- End::app-content -->

@section('scripts')

<script src="{{asset('assets/libs/select2/select2.min.js')}}"></script>
<script>
    $(document).ready(function() {
        $('.timezone').select2();
        $('.phonecode').select2();
        $(".lang").select2();
    });

    $("#generateApiKey").on("click", function() {

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            type: "POST",
            url: "/app/settings/generate-api-local",
            success: function(response) {
                $(".apikeylocal").val(response.message)
            },
            error: function(xhr, status, error) {

            },
        });
    });
</script>
@endsection

@endsection