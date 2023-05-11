@extends('frontend.partials.main')
@section('content')


<section class="our-contact">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-lg-4">
                <div class="contact_localtion text-center">
                    <div class="icon"><span class="flaticon-placeholder-1"></span></div>
                    <h4>Nous trouver</h4>
                    <p>Bafoussam, Cameroun</p>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="contact_localtion text-center">
                    <div class="icon"><span class="flaticon-phone-call"></span></div>
                    <h4>Nos contacts</h4>
                    <p class="mb0">Mobile: (+237) 468 235 <br> Fax: (+237) 468 235</p>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="contact_localtion text-center">
                    <div class="icon"><span class="flaticon-email"></span></div>
                    <h4>Notre boite mail</h4>
                    <p>Info@test.com</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div id="map-canvas">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3022.1422937950147!2d-73.98731968482413!3d40.75889497932681!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25855c6480299%3A0x55194ec5a1ae072e!2sTimes+Square!5e0!3m2!1ses-419!2sve!4v1510329142834" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>
            </div>
            <div class="col-lg-6 form_grid">
                <h4 class="mb5">Nous contacter</h4>
                <form class="contact_form" action="forms/contact.php" role="form" method="post">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="name">Votre Nom</label>
                                <input id="name" name="name" class="form-control" required="required" type="text">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="email">Votre Email</label>
                                <input id="email" name="email" class="form-control required email" required="required" type="email">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="subject">Subjet</label>
                                <input id="subject" name="subject" class="form-control required" required="required" type="text">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="message">Votre Message</label>
                                <textarea id="message" name="message" class="form-control required" rows="5" required="required"></textarea>
                            </div>
                            <div class="form-group ui_kit_button mb0">
                                <button type="submit" class="btn dbxshad btn-lg btn-thm circle white">Envoyer</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>



@endsection