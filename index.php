<?php include_once('inc/header.php'); ?>

<div class="position-relative">
  <ul class="controls " id="sliderFirstControls">
    <li class="prev">
      <i class="fas fa-angle-left"></i>
    </li>
    <li class="next">
      <i class="fas fa-angle-right"></i>
    </li>
  </ul>
  <div class="sliderFirst">
    <div class="item">
      <div class="py-23" style="background: linear-gradient(rgba(20, 30, 40, 0.5), rgba(20, 30, 40, 0.5)),
      rgba(20, 30, 40, 0.5) url(assets/images/slider/slider-1.jpg) no-repeat center;">
        <div class="container">
          <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
              <div>
                <!-- slider-captions -->
                <h1 class="display-3 text-white fw-bold">Personal Loan to Suit Your Needs. </h1>
                <p class="text-white d-none d-xl-block d-lg-block d-sm-block lead">The low rate you need for the need you want! Call
                  <br>
                  <strong>(555) 123-4567</strong></p>
                  <a href="apply_for_loan.php" class="btn btn-primary">Apply For Loan</a>
              </div>
              <!-- /.slider-captions -->
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="item">
      <div class="py-23" style="background:linear-gradient(rgba(20, 30, 40, 0.7), rgba(20, 30, 40, 0.7)),
      rgba(20, 30, 40, 0.5) url(assets/images/slider/slider-2.jpg) no-repeat center;">
        <div class="container">
          <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
              <div>
                <!-- slider-captions -->

                <h1 class="display-3 text-white fw-bold "> Lowest Car Loan Rate <strong class="text-warning">9.60%</strong> </h1>
                <p class="text-white d-none d-xl-block d-lg-block d-sm-block lead"> We provide an excellent service Loan company. Lorem ipsum simple dummy content goes here.
               </p>

               <a href="#loan_more" class="btn btn-primary">Find Loan Products</a>
              </div>
              <!-- /.slider-captions -->
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="item">
      <div class="py-23" style="background: linear-gradient(rgba(20, 30, 40, 0.5), rgba(20, 30, 40, 0.5)),
      rgba(20, 30, 40, 0.5) url(assets/images/slider/slider-3.jpg) no-repeat center;">
        <div class="container">
          <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
              <div>
                <!-- slider-captions -->
                <h1 class="display-3 text-white fw-bold">Loan with Great Rates.<strong class="text-warning">11.00%</strong> </h1>
                <p class="text-white d-none d-xl-block d-lg-block d-sm-block lead">We provide an excellent service for all types of loans in
                  <br> ahmedabad and offer service, advice and direction.</p>
                <a href="#emi_calculation" class="btn btn-primary">EMI Calculation</a>
              </div>
              <!-- /.slider-captions -->
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

<div id="loan_more" class="py-10 py-lg-16">
  <div class="container">
    <div class="row">
      <div class="offset-xl-2 col-xl-8 offset-lg-2 col-lg-8 col-md-12 col-sm-12 col-12">
        <div class="mb-10 text-center ">
          <!-- section title start-->
          <h1 class="mb-2">We Offers Loan Products </h1>
          <p class="lead px-lg-8">We will match you with a loan program that meet your financial need.</p>
        </div>
        <!-- /.section title start-->
      </div>
    </div>
    <div>
      <div class="row">

        <?php 
          $all = $emp->viewInterestRates();
          if ($all) {
            $i = 1;
            while ($row = $all->fetch_assoc()) {
              $i++;
        ?>
        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-3 col-12 mb-5">
          <div class="card text-center smooth-shadow-sm border-0 mb-4 mb-lg-0">
            <div class="card-body">
              <div class="mb-4 mt-4">
                <a href="apply_for_loan.php?apply_id=<?php echo $row['id']; ?>"> <img src="assets/images/svg/loan.svg" alt="Fast Loan - Loan Company" class="icon icon-xxl"></a>
              </div>

              <div class="lh-1 mb-2">
                  <h3 class="mb-2"><a href="#!" class="text-inherit"><?php echo $row['loan_purpose']; ?></a></h3>
                <h3 class="fw-bold text-primary mb-0"><?php echo $row['interest_rates']; ?>%</h3>
                <p class="fs-6">Rate of interest: </p>


              </div>
               <div class="d-grid mt-5 ">
                <a href="apply_for_loan.php?apply_id=<?php echo $row['id']; ?>" class="btn btn-outline-secondary btn-sm">Apply now</a>
              </div>

            </div>

          </div>
        </div>
        <?php 
        }
      } 
      ?>
        
      </div>
    </div>
  </div>
</div>

<div id="emi_calculation" class="bg-dual-gradient py-18">
  <div class="container">

    <div class="row">
      <div class="offset-xl-2 col-xl-8 offset-lg-2 col-lg-8 col-md-12 col-sm-12 col-12">
        <div class="text-center">
          <!-- section title start-->
          <h1 class="text-white">EMI Calculator</h1>
          <p class="text-white-50 lead mb-5">Understand what is the loan amount you are eligible.</p>
        </div>
        <!-- /.section title start-->
      </div>
      <div class="col-xl-10 offset-xl-1">
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
          <div class="form-group row">

            <div class="col-xl-3 col-lg-3 col-md-12">
                <input type="number" name="loan_amount" class="form-control" id="loanamount" placeholder="Enter expected loan" required>
            </div>
   
            <div class="col-xl-3 col-lg-3 col-md-12">
                <input type="number" name="installments" id="installments" class="form-control"  placeholder="Enter installments number" required>
            </div>

            <div class="col-xl-3 col-lg-3 col-md-12">
                <input type="number" name="loan_percent" class="form-control" id="loanpercentage" placeholder="Enter loan percent" required>
            </div>

            <div class="col-xl-3 col-lg-3 col-md-12">
                <input type="submit" name="submit" id="submit_btn" class="btn btn-warning form-control" value="Calculate">
            </div>

          </div> 
        </form>

        <div id="emiSection" class="col-xl-12 bg-white p-5 mt-5 d-none">
          <h3 class="title text-center">Your EMI is</h3>
          <p class="detail text-center mb-0 h3" style="color: #624bff;"></p>
        </div>
      </div>

      

    </div>
  </div>
</div>

<div class="py-lg-16 py-lg-14 py-10 bg-white border-top border-bottom">
  <div class="container">
    <div class="row">
      <div class="offset-xl-2 col-xl-8 offset-lg-2 col-lg-8 col-md-12 col-sm-12 col-12">
        <div class="mb-10 text-center">
          <!-- section title start-->
          <h1 class="mb-1">Reasons to choose us</h1>
          <p>Nunc iaculis velit a vestibulum cursu estibentum nec ante eu molestie.</p>
        </div>
        <!-- /.section title start-->
      </div>
    </div>
    <div class="row">
      <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
        <div class="mb-6 mb-lg-0 text-center">
          <div class="icon-shape icon-xxl bg-light rounded-circle mb-lg-5 mb-3"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-calculator  text-primary" viewBox="0 0 16 16">
                          <path d="M12 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h8zM4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4z"/>
                          <path d="M4 2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5v-2zm0 4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm0 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm0 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm3-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm0 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm0 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm3-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm0 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-4z"/>
                        </svg></div>
          <div class="feature-content">
            <h3 class="feature-title">EMI Calculator</h3>
            <p>Fusce sed erat libasellus id orciquise ctus velit, asimple male suada urna sodales eu.</p>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
        <div class="mb-6 mb-lg-0 text-center">
          <div class="icon-shape icon-xxl bg-light rounded-circle mb-lg-5 mb-3 "><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-heart text-primary" viewBox="0 0 16 16">
              <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
            </svg></div>
          <div class="feature-content">
            <h3 class="feature-title">Customers love us!</h3>
            <p>Quisque ut ligula nec est pretium phareest male sunec atmetus mattis volutpat elit.</p>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
        <div class="mb-6 mb-lg-0 text-center">
          <div class="icon-shape icon-xxl bg-light rounded-circle mb-lg-5 mb-3 "> <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-file-earmark-richtext text-primary" viewBox="0 0 16 16">
              <path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h-2z"/>
              <path d="M4.5 12.5A.5.5 0 0 1 5 12h3a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zm0-2A.5.5 0 0 1 5 10h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zm1.639-3.708 1.33.886 1.854-1.855a.25.25 0 0 1 .289-.047l1.888.974V8.5a.5.5 0 0 1-.5.5H5a.5.5 0 0 1-.5-.5V8s1.54-1.274 1.639-1.208zM6.25 6a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5z"/>
            </svg></div>
          <div class="feature-content">
            <h3 class="feature-title">Easy Documentation </h3>
            <p>Vestibulum elementum pellent esques ittnunc dui in massa variusare augue feugiat.</p>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
        <div class="mb-4 mb-lg-0 text-center">
          <div class="icon-shape icon-xxl bg-light rounded-circle mb-5 "><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-lightning text-primary" viewBox="0 0 16 16">
              <path d="M5.52.359A.5.5 0 0 1 6 0h4a.5.5 0 0 1 .474.658L8.694 6H12.5a.5.5 0 0 1 .395.807l-7 9a.5.5 0 0 1-.873-.454L6.823 9.5H3.5a.5.5 0 0 1-.48-.641l2.5-8.5zM6.374 1 4.168 8.5H7.5a.5.5 0 0 1 .478.647L6.78 13.04 11.478 7H8a.5.5 0 0 1-.474-.658L9.306 1H6.374z"/>
            </svg></div>
          <div class="feature-content">
            <h3 class="feature-title">Fast Approval</h3>
            <p>Pellent esques ittnunc vene nata uri bulum eleme ntum in massa varnare augue feugiat.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="pt-lg-8 pb-14">
  <div class="container">
    <div class="row">
      <div class="offset-xl-2 col-xl-8 offset-lg-2 col-lg-8 col-md-12 col-sm-12 col-12">
        <div class="mb-10 text-center ">
          <!-- section title start-->
          <h1 class="mb-2">Frequently Asked Questions</h1>
          <p class="mb-0">Nulla rutrum tellus vel mauris tristique gravida in vulputate velit. Nulla dictum porttitor diam, ut molestie lorem mattis</p>
        </div>
        <!-- /.section title start-->
      </div>
    </div>
    <div class="row">
      <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
        <div class="accordion" id="faqExample">
          <div class="card mb-2">
            <div class="card-header rounded-3 border-bottom-0" id="faqOne">
              <h4 class="mb-0">
                <a href="#!" data-bs-toggle="collapse" data-bs-target="#faqcollapseOne" aria-expanded="true" aria-controls="faqcollapseOne">
                  <i class="fa fa-plus-circle me-2"></i>How much can I borrow?</a>
              </h4>
            </div>
            <div id="faqcollapseOne" class="collapse show" aria-labelledby="faqOne" data-bs-parent="#faqExample">
              <div class="card-body border-top">
                <p>  Anim pariatur cliche repre henderit, enim eiusmod high life accusamus terry richardson ad squid. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird
                    on it squid single-origin coffee nulla assumenda shoreditch et. </p>
                <p>Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.  VHS.</p>
              </div>
            </div>
          </div>
          <div class="card mb-2">
            <div class="card-header rounded-3 border-bottom-0" id="faqTwo">
              <h4 class="mb-0">
                <a href="#!" class="collapsed" data-bs-toggle="collapse" data-bs-target="#faqcollapseTwo" aria-expanded="false" aria-controls="faqcollapseTwo">
                  <i class="fa fa-plus-circle me-2"></i>Can I pay off my loan early?</a>
              </h4>
            </div>
            <div id="faqcollapseTwo" class="collapse" aria-labelledby="faqTwo" data-bs-parent="#faqExample">
              <div class="card-body border-top">
                  Morbi venenatis posuere risus. Nulla tempor urna erat, ut consectetur purus convallis eget.Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table,
                raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
              </div>
            </div>
          </div>
          <div class="card mb-2">
            <div class="card-header rounded-3 border-bottom-0" id="faqThree">
              <h4 class="mb-0">
                <a href="#!" class="collapsed" data-bs-toggle="collapse" data-bs-target="#faqcollapseThree" aria-expanded="false" aria-controls="faqcollapseThree">
                  <i class="fa fa-plus-circle me-2"></i>Do you offering refinancing ?</a>
              </h4>
            </div>
            <div id="faqcollapseThree" class="collapse" aria-labelledby="faqThree" data-bs-parent="#faqExample">
              <div class="card-body border-top">
                  Morbi venenatis posuere risus. Nulla tempor urna erat, ut consectetur purus convallis eget. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table,
                raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
              </div>
            </div>
          </div>
          <div class="card mb-2">
            <div class="card-header rounded-3 border-bottom-0" id="faqfour">
              <h4 class="mb-0">
                <a href="#!" class="collapsed" data-bs-toggle="collapse" data-bs-target="#faqcollapsefour" aria-expanded="false" aria-controls="faqcollapsefour">
                  <i class="fa fa-plus-circle me-2"></i>When should i apply?</a>
              </h4>
            </div>
            <div id="faqcollapsefour" class="collapse" aria-labelledby="faqfour" data-bs-parent="#faqExample">
              <div class="card-body border-top">
                Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
          <div class="accordion" id="faqExample2">
            <div class="card mb-2">
              <div class="card-header rounded-3 border-bottom-0" id="faqFive">
                <h4 class="mb-0">
                  <a href="#!" data-bs-toggle="collapse" data-bs-target="#faqcollapseFive" aria-expanded="true" aria-controls="faqcollapseFive">
                    <i class="fa fa-plus-circle me-2"></i>How much can I borrow?</a>
                </h4>
              </div>
              <div id="faqcollapseFive" class="collapse show" aria-labelledby="faqFive" data-bs-parent="#faqExample2">
                <div class="card-body border-top">
                  <p>  Anim pariatur cliche repre henderit, enim eiusmod high life accusamus terry richardson ad squid. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird
                      on it squid single-origin coffee nulla assumenda shoreditch et. </p>
                  <p>Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.  VHS.</p>
                </div>
              </div>
            </div>
            <div class="card mb-2">
              <div class="card-header rounded-3 border-bottom-0" id="faqSix">
                <h4 class="mb-0">
                  <a href="#!" class="collapsed" data-bs-toggle="collapse" data-bs-target="#faqcollapseSix" aria-expanded="false" aria-controls="faqcollapseSix">
                    <i class="fa fa-plus-circle me-2"></i>Can I pay off my loan early?</a>
                </h4>
              </div>
              <div id="faqcollapseSix" class="collapse" aria-labelledby="faqSix" data-bs-parent="#faqExample2">
                <div class="card-body border-top">
                  Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird
                  on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table,
                  raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                </div>
              </div>
            </div>
            <div class="card mb-2">
              <div class="card-header rounded-3 border-bottom-0" id="faqSeven">
                <h4 class="mb-0">
                  <a href="#!" class="collapsed" data-bs-toggle="collapse" data-bs-target="#faqcollapseSeven" aria-expanded="false" aria-controls="faqcollapseSeven">
                    <i class="fa fa-plus-circle me-2"></i>Do you offering refinancing ?</a>
                </h4>
              </div>
              <div id="faqcollapseSeven" class="collapse" aria-labelledby="faqSeven" data-bs-parent="#faqExample2">
                <div class="card-body border-top">
                  Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird
                  on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table,
                  raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header rounded-3 border-bottom-0" id="faqEight">
                <h4 class="mb-0">
                  <a href="#!" class="collapsed" data-bs-toggle="collapse" data-bs-target="#faqcollapseEight" aria-expanded="false" aria-controls="faqcollapseEight">
                    <i class="fa fa-plus-circle me-2"></i>When should i apply?</a>
                </h4>
              </div>
              <div id="faqcollapseEight" class="collapse" aria-labelledby="faqEight" data-bs-parent="#faqExample2">
                <div class="card-body border-top">
                  Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
  </div>
</div>

<?php include_once('inc/footer.php'); ?>