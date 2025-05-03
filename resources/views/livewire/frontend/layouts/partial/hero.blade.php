  <!-- Hero Section -->
  <section id="hero" class="hero section dark-background">

    <img src="{{asset('frontend/assets') }}/img/hero-bg.png" class="hero-bg" alt="" data-aos="fade-in">

    <div class="container text-center" data-aos="fade-up" data-aos-delay="100">      
      <h2>Welcome to {{ settings('app_name', env('APP_NAME', 'MyApp')) }}'s world</h2>
      <p>Our dream is <span class="typed" data-typed-items="{{settings('header_text')}}"></span></p>
      <div>
        <a href="#about" class="cta-btn">Get Started</a>
        <a href="#team" class="cta-btn2">Our Partners</a>
      </div>
    </div>

  </section><!-- /Hero Section -->
