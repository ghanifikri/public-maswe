@extends('frontend.layouts.app')

@section('hero')
<!-- ======= Top Header ======= -->
<div class="top-header">
    <div class="page-header d-flex align-items-center"
        style="background-image: url('{{ asset('frontend/img/produk1.jpg')}}');">
        <div class="container position-relative">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-6 text-center">
                    <h2>How Can We Help?</h2>
                    <p>Send Us a message</p>
                </div>
            </div>
        </div>
    </div>
</div><!-- End Top Header -->
@endsection

@section('content')
<!-- ======= About Section ======= -->
<section id="contact" class="contact">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 ">
                <iframe class="mb-4 mb-lg-0"
                    src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d18871.720076720347!2d105.92877524795017!3d-6.09152162139484!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e4187c00edd71a5%3A0x9b5c1cbd952b7565!2sAF%20Design!5e0!3m2!1sen!2sid!4v1674805331539!5m2!1sen!2sid"
                    frameborder="0" style="border:0; width: 100%; height: 384px;" allowfullscreen></iframe>
            </div>
            <div class="col-lg-6">
                <form autocomplete="off" id="contactForm" action="{{ route('kontak.store') }}" method="post" role="form"
                    class="contact-form">
                    @csrf
                    <div class="row">
                        <div class="col form-group">
                            <input type="text" name="name" id="name" class="form-control" id="name"
                                placeholder="Your Name" required>
                        </div>
                        <div class="col form-group">
                            <input type="email" class="form-control" name="email" id="email" placeholder="Your Email"
                                required>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject"
                            required>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" id="message" name="message" rows="6" placeholder="Message"
                            required></textarea>
                    </div>
                    <button class="btn-contact btn-block" type="submit">Send Message</button>
                </form>
            </div>

        </div>

    </div>
</section><!-- End About Section -->
<div class="modal fade" id="success" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h2 class="text-success">Thank you!</h2>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <p class="text-success">Your message is successfully sent...</p>
        </div>
      </div>
    </div>
</div>

<!-- Modals error -->
<div class="modal fade" id="error" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h2 class="text-warning">Sorry!</h2>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <p class="text-warning">Something went wrong.</p>
        </div>
      </div>
    </div>
</div>
@endsection

@section('js')

@endsection
