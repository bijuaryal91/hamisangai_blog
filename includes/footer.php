 <footer class="footer">
     <div class="container">
         <div class="footer-content">
             <div class="footer-about">
                 <h3>HamiSangai</h3>
                 <p><?php echo $setting['footer_text']; ?></p>

                 <?php
                    $stmt = $conn->prepare("SELECT * FROM site_social_links");
                    $stmt->execute();
                    $socials = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    if ($socials) {
                        // Mapping platform to icon class
                        $iconMap = [
                            'facebook' => 'fab fa-facebook-f',
                            'twitter' => 'fab fa-twitter',
                            'instagram' => 'fab fa-instagram',
                            'linkedin' => 'fab fa-linkedin-in',
                        ];
                    ?>
                     <div class="social-links">
                         <?php foreach ($socials as $social):
                                $platform = strtolower($social['platform']); // Ensure it's lowercase
                                $url = htmlspecialchars($social['url'], ENT_QUOTES, 'UTF-8');
                                $icon = $iconMap[$platform] ?? 'fas fa-link'; // Fallback icon
                            ?>
                             <a href="<?= $url ?>" target="_blank" aria-label="<?= ucfirst($platform) ?>">
                                 <i class="<?= $icon ?>"></i>
                             </a>
                         <?php endforeach; ?>
                     </div>
                 <?php
                    }
                    ?>

             </div>
             <div class="footer-links">
                 <h3>Quick Links</h3>
                 <ul>
                     <li><a href="index.php">Home</a></li>
                     <li><a href="index.php#about">About</a></li>
                     <li><a href="index.php#services">Services</a></li>
                     <li><a href="blog.php">Blog</a></li>
                     <li><a href="index.php#contact">Contact</a></li>
                 </ul>
             </div>
             <div class="footer-newsletter">
                 <h3>Newsletter</h3>
                 <p>Subscribe to our newsletter for the latest updates.</p>
                 <form class="newsletter-form">
                     <input type="email" placeholder="Your email" required>
                     <button class="btn btn-primary submit-newsletter">Subscribe</button>
                 </form>
                 <script>
                     document.querySelector('.submit-newsletter').addEventListener("click", (e) => {
                         e.preventDefault();
                         const newsletter = document.querySelector('.newsletter-form input');
                         const newsletter_email = newsletter.value;
                         if (newsletter_email === "") {

                             alert("Enter Email");
                         } else {
                             const pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                             if (pattern.test(newsletter_email)) {
                                 let xhr = new XMLHttpRequest();
                                 xhr.open("POST", "./php/submit_newsletter.php");


                                 xhr.onload = () => {
                                     if (xhr.readyState == XMLHttpRequest.DONE) {
                                         if (xhr.status == 200) {
                                             let data = xhr.response;
                                             if (data == "success") {
                                                 alert("Thank you for subscribing.");
                                                 newsletter.value ="";
                                             } else {
                                                 alert(data);
                                             }
                                         }
                                     }
                                 }
                                 const formData = new FormData();
                                 formData.append('email', newsletter_email);

                                 xhr.send(formData);

                             } else {
                                 alert("Please enter valid email.");
                             }
                         }
                     });
                 </script>
             </div>
         </div>
         <div class="footer-bottom">
             <p>&copy; <?php echo date('Y');  ?> <?php echo $setting['sitename']; ?>. All rights reserved.</p>
         </div>
     </div>
 </footer>