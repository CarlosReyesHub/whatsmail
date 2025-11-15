<div class="col-12 col-md-2 border-end">
    <div class="card-body">
        <h4 class="subheader">Pengaturan Device</h4>
        <div class="list-group list-group-transparent">
            <a href="{{route('waba.update',$idwaba)}}" class="list-group-item list-group-item-action d-flex align-items-center active border-bottom">Umum</a>
            <a href="{{route('waba.autoreply',$idwaba)}}" class="list-group-item list-group-item-action d-flex align-items-center border-bottom">Auto Reply</a>
            <a href="{{route('waba.greeting',$idwaba)}}" class="list-group-item list-group-item-action d-flex align-items-center border-bottom">Sapaan</a>
            <a href="{{route('waba.token',$idwaba)}}" class="list-group-item list-group-item-action d-flex align-items-center border-bottom">Token</a>
            <a href="{{route('waba.templates',$idwaba)}}" class="list-group-item list-group-item-action d-flex align-items-center border-bottom">Template Pesan</a>
        </div>
        <h4 class="subheader mt-4">Tindakan</h4>
        <div class="list-group list-group-transparent">
            <a href="{{route('waba.refresh',$idwaba)}}" class="list-group-item list-group-item-action text-info ">Refresh</a>
            <a href="{{ route('waba.delete',$idwaba) }}" class="list-group-item list-group-item-action text-danger deletebutton">Hapus Integrasi</a>
            
        </div>
    </div>
</div>