  <?php
  include('config.php');
  ?>
  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml">
      <head>
          <title><?php echo COFIG_SITE_NAME; ?> API Document</title>
          <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
          <style type="text/css">
              a {
                      text-decoration:none;
                      color:#3399FF;
              }
              h2 {
                       color:#660066;
              }
              li {
                      color:#993300;
              }
          </style>
      </head>
      <body>
  		<h1><?php echo COFIG_SITE_NAME; ?> API Document</h1>
          <h2>User Login, Registration</h2>
          <ul>
              <li>check user is register or not
                  <br/>
                      <a href="<?php echo COFIG_API_URL; ?>webapi_login.php?device_token=1234" target="_blank">
                          <?php echo COFIG_API_URL; ?>webapi_login.php?device_token=1234
                      </a>
                  <ul>
                      <br/>
                      <li>
                          0 "Your account is inactive."
                      </li>
                      <li>
                          1 "User is successfully login."
                      </li>
                      <li>
                          2 "Your account is removed by admin."
                      </li>
                      <li>
                          3 "Your account is not register."
                      </li>
                      <li>
                          4 "please try again letter."
                      </li>
                      <br/>
                  </ul>
              </li>
              <li>Registration
                  <br/>
                      <a href="<?php echo COFIG_API_URL; ?>webapi_signup.php?email=valahp@gmail.com&name=Hitesh Ahir&device_token=1234" target="_blank">
                      <?php echo COFIG_API_URL; ?>webapi_signup.php?email=valahp@gmail.com&name=Hitesh Ahir&device_token=1234
                      </a>
                  <ul>
                      <br/>
                      <li>
                          1 "Your account has been created successfully."
                      </li>
                      <li>
                          0 "Email address is already exists."
                      </li>
                      <br/>
                  </ul>
              </li>
          </ul>
          <h2>CMS</h2>
          <ul>
            <li>About us Page
                <br/>
                    <a href="<?php echo COFIG_API_URL; ?>webapi_cms.php?cms_id=1&userid=14&device_token=123" target="_blank">
                        <?php echo COFIG_API_URL; ?>webapi_cms.php?cms_id=1&userid=14&device_token=123
                    </a>
                <ul>
                    <br/>
                    <li>
                        0 "No Record found."
                    </li>
                    <li>
                        1 "Success."
                    </li>
                    <li>
                        2 "Invalid User."
                    </li>
                    <li>
                        3 "Invalid Token."
                    </li>
                    <br/>
                </ul>
            </li>
              <li>Help Page
                  <br/>
                      <a href="<?php echo COFIG_API_URL; ?>webapi_cms.php?cms_id=2&userid=14&device_token=123" target="_blank">
                          <?php echo COFIG_API_URL; ?>webapi_cms.php?cms_id=2&userid=14&device_token=123
                      </a>
                  <ul>
                      <br/>
                      <li>
                          0 "No Record found."
                      </li>
                      <li>
                          1 "Success."
                      </li>
                      <li>
                          2 "Invalid User."
                      </li>
                      <li>
                          3 "Invalid Token."
                      </li>
                      <br/>
                  </ul>
              </li>
              <li>Contact Us
                  <br/>
                      <a href="<?php echo COFIG_API_URL; ?>webapi_contact_us.php?name=Ghanshyam&email=ghanshyams011@gmail.com&mobile=9998749341&message=This is the testing api." target="_blank">
                          <?php echo COFIG_API_URL; ?>webapi_contact_us.php?name=Ghanshyam&email=ghanshyams011@gmail.com&mobile=9998749341&message=This is the testing api.
                      </a>
                  <ul>
                      <br/>
                      <li>
                          0 "No Record found."
                      </li>
                      <li>
                          1 "Success."
                      </li>
                      <li>
                          2 "Invalid User."
                      </li>
                      <li>
                          3 "Invalid Token."
                      </li>
                      <br/>
                  </ul>
              </li>
          </ul>
            <h2>Module</h2>
            <ul>
              <li>Fragnets Management
                  <br/>
                      <a href="<?php echo COFIG_API_URL; ?>webapi_fragnets.php?userid=14&device_token=123" target="_blank">
                          <?php echo COFIG_API_URL; ?>webapi_fragnets.php?userid=14&device_token=123
                      </a>
                  <ul>
                      <br/>
                      <li>
                          0 "No Data found."
                      </li>
                      <li>
                          1 "Success."
                      </li>
                      <li>
                          2 "Invalid User."
                      </li>
                      <li>
                          3 "Invalid Token."
                      </li>
                      <br/>
                  </ul>
              </li>
              <li>EVM Management
                  <br/>
                      <a href="<?php echo COFIG_API_URL; ?>webapi_evm.php?userid=14&device_token=123" target="_blank">
                          <?php echo COFIG_API_URL; ?>webapi_evm.php?userid=14&device_token=123
                      </a>
                  <ul>
                      <br/>
                      <li>
                          0 "No Data found."
                      </li>
                      <li>
                          1 "Success."
                      </li>
                      <li>
                          2 "Invalid User."
                      </li>
                      <li>
                          3 "Invalid Token."
                      </li>
                      <br/>
                  </ul>
              </li>
              <li>Work Breakdown Structure Management
                  <br/>
                      <a href="<?php echo COFIG_API_URL; ?>webapi_breakdown.php?userid=14&device_token=123" target="_blank">
                          <?php echo COFIG_API_URL; ?>webapi_breakdown.php?userid=14&device_token=123
                      </a>
                  <ul>
                      <br/>
                      <li>
                          0 "No Data found."
                      </li>
                      <li>
                          1 "Success."
                      </li>
                      <li>
                          2 "Invalid User."
                      </li>
                      <li>
                          3 "Invalid Token."
                      </li>
                      <br/>
                  </ul>
              </li>
              <li>Schedule Analytics Management
                  <br/>
                      <a href="<?php echo COFIG_API_URL; ?>webapi_schedule_analytics.php?userid=14&device_token=123" target="_blank">
                          <?php echo COFIG_API_URL; ?>webapi_schedule_analytics.php?userid=14&device_token=123
                      </a>
                  <ul>
                      <br/>
                      <li>
                          0 "No Data found."
                      </li>
                      <li>
                          1 "Success."
                      </li>
                      <li>
                          2 "Invalid User."
                      </li>
                      <li>
                          3 "Invalid Token."
                      </li>
                      <br/>
                  </ul>
              </li>
              <li>Forensic Management
                  <br/>
                      <a href="<?php echo COFIG_API_URL; ?>webapi_forensic.php?userid=14&device_token=123" target="_blank">
                          <?php echo COFIG_API_URL; ?>webapi_forensic.php?userid=14&device_token=123
                      </a>
                  <ul>
                      <br/>
                      <li>
                          0 "No Data found."
                      </li>
                      <li>
                          1 "Success."
                      </li>
                      <li>
                          2 "Invalid User."
                      </li>
                      <li>
                          3 "Invalid Token."
                      </li>
                      <br/>
                  </ul>
              </li>
              <li>Assessment category
                  <br/>
                      <a href="<?php echo COFIG_API_URL; ?>webapi_assessment_category.php?userid=14&device_token=743B517E-8147-406B-975E-A192F7AE5F51" target="_blank">
                          <?php echo COFIG_API_URL; ?>webapi_assessment_category.php?userid=14&device_token=743B517E-8147-406B-975E-A192F7AE5F51
                      </a>
                  <ul>
                      <br/>
                      <li>
                        0 "No Data found."
                      </li>
                      <li>
                          1 "Success."
                      </li>
                      <li>
                        2 "Invalid User."
                      </li>
                      <li>
                        3 "Invalid token."
                      </li>
                      <br/>
                  </ul>
              </li>
              <li>Assessment Question List (Categorywise)
                  <br/>
                      <a href="<?php echo COFIG_API_URL; ?>webapi_assessment.php?categoryid=1&userid=14&device_token=123" target="_blank">
                          <?php echo COFIG_API_URL; ?>webapi_assessment.php?categoryid=1&userid=14&device_token=123
                      </a>
                  <ul>
                      <br/>
                      <li>
                          0 "No Data found."
                      </li>
                      <li>
                          1 "Success."
                      </li>
                      <li>
                        2 "Invalid User."
                      </li>
                      <li>
                        3 "Invalid token."
                      </li>
                      <br/>
                  </ul>
              </li>
              <li>Assessment User Answer
                  <br/>
                      <a href="<?php echo COFIG_API_URL; ?>webapi_assessment_answer.php?categoryid=1&assessmentsid=1&answer=1&usertempid=temp123&userid=14&device_token=123" target="_blank">
                          <?php echo COFIG_API_URL; ?>webapi_assessment_answer.php?categoryid=1&assessmentsid=1&answer=1&usertempid=temp123&userid=14&device_token=123
                      </a>
                  <ul>
                      <br/>
                      <li>
                          0 "No Data found."
                      </li>
                      <li>
                          1 "Success."
                      </li>
                      <li>
                        2 "Invalid User."
                      </li>
                      <li>
                        3 "Invalid token."
                      </li>
                      <br/>
                  </ul>
              </li>
              <li>Assessment User Results
                  <br/>
                      <a href="<?php echo COFIG_API_URL; ?>webapi_assessment_results.php?categoryid=1&usertempid=temp12345&userid=14&device_token=123" target="_blank">
                          <?php echo COFIG_API_URL; ?>webapi_assessment_results.php?categoryid=1&usertempid=temp12345&userid=14&device_token=123
                      </a>
                  <ul>
                      <br/>
                      <li>
                          0 "No Data found."
                      </li>
                      <li>
                          1 "Success."
                      </li>
                      <li>
                        2 "Invalid User."
                      </li>
                      <li>
                        3 "Invalid token."
                      </li>
                      <br/>
                  </ul>
              </li>
              <li>Project Wheel API (Project Wheel Front)
                  <br/>
                      <a href="<?php echo COFIG_API_URL; ?>webapi_projectwheel.php?userid=14&device_token=789&wheeltype=1" target="_blank">
                          <?php echo COFIG_API_URL; ?>webapi_projectwheel.php?userid=14&device_token=789&wheeltype=1
                      </a>
                  <ul>
                      <br/>
                      <li>
                          0 "No Data found."
                      </li>
                      <li>
                          1 "Success."
                      </li>
                      <li>
                        2 "Invalid User."
                      </li>
                      <li>
                        3 "Invalid token."
                      </li>
                      <br/>
                  </ul>
              </li>
              <li>Project Wheel API (Project Wheel Back)
                  <br/>
                      <a href="<?php echo COFIG_API_URL; ?>webapi_projectwheel.php?userid=14&device_token=789&wheeltype=2" target="_blank">
                          <?php echo COFIG_API_URL; ?>webapi_projectwheel.php?userid=14&device_token=789&wheeltype=2
                      </a>
                  <ul>
                      <br/>
                      <li>
                          0 "No Data found."
                      </li>
                      <li>
                          1 "Success."
                      </li>
                      <li>
                        2 "Invalid User."
                      </li>
                      <li>
                        3 "Invalid token."
                      </li>
                      <br/>
                  </ul>
              </li>
              <li>Risk Management
                  <br/>
                      <a href="<?php echo COFIG_API_URL; ?>webapi_risk.php?userid=14&device_token=1234" target="_blank">
                          <?php echo COFIG_API_URL; ?>webapi_risk.php?userid=14&device_token=1234
                      </a>
                  <ul>
                      <br/>
                      <li>
                          0 "No Data found."
                      </li>
                      <li>
                          1 "Success."
                      </li>
                      <li>
                          2 "Invalid User."
                      </li>
                      <li>
                          3 "Invalid Token."
                      </li>
                      <br/>
                  </ul>
              </li>

          </ul>
      </body>
  </html>
