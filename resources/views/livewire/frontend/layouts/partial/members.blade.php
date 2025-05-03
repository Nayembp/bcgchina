 <!-- Services Section -->
 <section id="members" class="services section light-background">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
      <h2>Our Members</h2>
      <p>We are a group of energitic partners! Working togather to improve our company and reach to the goal</p>
    </div><!-- End Section Title -->

    <div class="container">

      <div class="row gy-4">

       
        @foreach($members as $member)
        <div class="col-lg-4 col-md-6 service-item d-flex" data-aos="fade-up" data-aos-delay="200">
          <div class="icon flex-shrink-0"><img src="{{ asset('storage/' .$member->image) }}" class="img-fluid" alt=""></div>
          <div>
            <h4 class="title">{{$member->name}}</h4>
            <p class="description">{{$member->university}} <br>
              {{$member->current_address}}
            </p>
          </div>
        </div>
        @endforeach

        {{-- <div class="col-lg-4 col-md-6 service-item d-flex" data-aos="fade-up" data-aos-delay="300">
          <div class="icon flex-shrink-0"><i class="bi bi-bar-chart"></i></div>
          <div>
            <h4 class="title"><a href="service-details.html" class="stretched-link">Sed ut perspiciatis</a></h4>
            <p class="description">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur</p>
          </div>
        </div><!-- Original --> --}}

        
      </div>

    </div>

  </section><!-- /Services Section -->
