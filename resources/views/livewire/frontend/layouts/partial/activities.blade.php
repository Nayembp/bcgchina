 <!-- Team Section -->
 <section id="activities" class="team section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
      <h2>Our Projects</h2>
      <p>We have many projects running!</p>
    </div><!-- End Section Title -->

    <div class="container">

      <div class="row gy-4">
        @foreach($activities as $activity)
          <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
            <div class="team-member">
              <div class="member-img">
                <img src="{{ asset('storage/' .$activity->banner) }}" class="img-fluid" alt="">
                <div class="social">
                  <a href=""><i class="bi bi-twitter-x"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>{{$activity->name}}</h4>
                <span>{{$activity->description}}</span>
              </div>
            </div>
          </div><!-- End Team Member -->
        @endforeach        

      </div>

    </div>

  </section><!-- /Team Section -->
