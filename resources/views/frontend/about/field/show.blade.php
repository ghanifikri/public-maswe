<div class="modal-content">
              
    <!-- Modal Header -->
    <div class="modal-header">
      <h4>{{ $data->nama_fasilitas }}</h4>
    </div>

    <!-- Modal body -->
    <div class="modal-body">
        <div class="row align-items-center">
            <div class="col-12 col-md-7 col-lg-7">
                <img src="{{ asset($data->image) }}" class="modal-image" alt="Modal Image">
            </div>
            <div class="col-12 col-md-5 col-lg-5 text-center">
                <p>{{ $data->description }}</p>
            </div>
        </div>
    </div>          
  </div>