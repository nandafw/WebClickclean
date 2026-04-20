<section id="footer" class="section-footer">
            <div class="container-grd4">
                <div class="box">
                    <a href="link-to-homepage">
                        <img src="{{ asset('images/Logo2.png') }}" class="bx" alt="">
                    </a>
                    <p>Jasa kebersihan yang berkualitas, terjangkau dan profesional. Jadwalkan pembersihan anda sekarang!</p>
                    <a href="link-to-social-media">
                        <img src="{{ asset('images/Icon Social Media.png') }}" class="bx" alt="">
                    </a>
                </div>
                <div class="box2">
                    <h3>Quick Links</h3>
                    <ul>
                        <li class="footer-list"><a href="{{ route('about') }}">Tentang Kami</a></li>
                        <br>
                        <li class="footer-list"><a href="{{ route('product.index') }}">Product</a></li>
                        <br>
                        <li class="footer-list"><a href="{{ route('user.booking.index') }}">Booking</a></li>
                        <br>
                        <li class="footer-list"><a href="{{ route('contact') }}">Contact Us</a></li>
                    </ul>
                </div>
                <div class="box3">
                    <h3>Layanan</h3>
                    <ul>
                        <li class="footer-list"><a href="{{ route('service') }}">Layanan Rumah</a></li>
                        <br>
                        <li class="footer-list"><a href="{{ route('service') }}">Layanan Kantor</a></li>
                        <br>
                        <li class="footer-list"><a href="{{ route('service') }}">Layanan Industri</a></li>
                        <br>
                        <li class="footer-list"><a href="{{ route('service') }}">Layanan AC</a></li>
                 </ul>
                </div>
             <div class="box">
                    <h3>Newsletter</h3>
                    <p>Masukkan emailmu, dapatkan lebih banyak pemberitahuan dari kami.</p>
                    <form action="" method="POST">
                     <input type="text" name="email" class="form_email" placeholder="Masukkan Email">
                     <button type="submit" class="button"><i class="fa fa-send-o"></i></button>
                    </form>
             </div>
            </div>
</section>