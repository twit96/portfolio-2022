<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>Tyler Wittig | Admin</title>
		<meta charset="utf-8" />
		<meta name="description" content="Tyler Wittig's Portfolio Admin Dashboard" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="icon" href="/img/icon.png" />
		<link rel="stylesheet" type="text/css" href="/css/main.css" />
		<link rel="stylesheet" type="text/css" href="/css/admin.css" />
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
		<script src="/js/main.js" defer></script>
		<meta name="robots" content="noindex">
  </head>
  <body>
    <div id="loader"></div>

    <span id="scroll-down-indicator"></span>
    <span id="scroll-top-btn"></span>

    <header>
      <div class="wrapper">
        <span>
          <a href="/">TW</a>
        </span>
        <nav>
          <a href="/">Home</a>
          <a href="/projects">Projects</a>
          <a class="resume" href="/20211003-résumé-tylerwittig.pdf">
            Résumé
          </a>
          <div id="dark-toggle-wrap">
            <span class="slider"></span>
          </div>
        </nav>
        <div class="nav-toggle">
          <span></span>
          <span></span>
          <span></span>
        </div>
        <div id="header-bg"></div>
      </div>
    </header>

    <main id="admin">
      <div class="wrapper">

        <h1>Admin</h1>
        <section id="login">
          <h2>Login</h2>
          <div class="flex">
            <form method="POST" action="admin.php">
              <label>
                <input name="username" type="text" required />
                <span>Username</span>
              </label>
              <label>
                <input name="password" type="password" required />
                <span>Password</span>
              </label>
              <p>
                <input name="login" type="submit" value="Submit" />
                <input type="reset" value="Reset" />
              </p>
            </form>
            <p>
              The place where super duper top secret things definitely do not occur...
            </p>
          </div>
        </section>

        <div class="flex">
          <div class="left">
            <section id="edit-projects" class="card">
              <h2>Edit Projects</h2>

              <h3 class="accordion" onclick="this.classList.toggle('active');"><span>(2021-10-01)</span> <span>Project Title 1</span></h3>
              <div class="panel">
                <h4 class="accordion" onclick="this.classList.toggle('active');">Details</h4>
                <form method="POST" action="admin" enctype="multipart/form-data" class="panel">
                  <input name="submitted_data" type="hidden" value="project" />
                  <input name="id" type="hidden" value="1" />
                  <input name="author_id" type="hidden" value="1" />
                  <div class="label-group">
                    <label>
                      <input type="text" name="title" value="Project Title 1" />
                      <span>Title</span>
                    </label>
                    <label>
                      <input type="date" name="date" value="2021-10-01" />
                      <span>Date</span>
                    </label>
                  </div>
                  <div class="label-group">
                    <label>
                      <input type="text" name="directory" value="project-title-1" />
                      <span>Directory</span>
                    </label>
                    <label>
                      <input type="file" name="image" accept="image/png, image/jpg, image/jpeg" />
                      <span>Image</span>
                    </label>
                  </div>
                  <label>
                    <input type="text" name="blurb" value="Project 1 Blurb about the Project" />
                    <span>Blurb</span>
                  </label>
                  <label>
                    <textarea name="description">Project 1 Description about the Project describes it very well for the most part we think.</textarea>
                    <span>Description</span>
                  </label>
                  <div class="label-group">
                    <label>
                      <input type="number" name="featured" min="0" value="1" />
                      <span>Featured</span>
                    </label>
                    <div class="submit-toggle">
                      <input type="checkbox" name="toggle" />
                      <input name="update" type="submit" value="Update" />
                    </div>  <!-- ./submit-toggle -->
                  </div>  <!-- ./label-group -->
                </form>
                <h4 class="accordion" onclick="this.classList.toggle('active');">Links</h4>
                <div class="panel">
                  <h5 class="accordion" onclick="this.classList.toggle('active');">Primary Link</h5>
                  <form method="POST" action="admin" enctype="multipart/form-data" class="panel">
                    <input name="submitted_data" type="hidden" value="link" />
                    <input name="id" type="hidden" value="1" />
                    <div class="label-group">
                      <label>
                        <input type="text" name="link-text" value="View Project" />
                        <span>Text</span>
                      </label>
                      <label>
                        <input type="text" name="link-url" value="https://twit96.github.io/minesweeper/" />
                        <span>URL</span>
                      </label>
                      <div class="submit-toggle">
                        <input name="update" type="submit" value="Update" style="margin-left: auto;" />
                      </div>  <!-- ./submit-toggle -->
                    </div>
                  </form>
                  <h5 class="accordion" onclick="this.classList.toggle('active');">Other Links</h5>
                  <div class="panel">
                    <form method="POST" action="admin" enctype="multipart/form-data">
                      <input name="submitted_data" type="hidden" value="link" />
                      <input name="id" type="hidden" value="2" />
                      <div class="label-group">
                        <label>
                          <input type="text" name="link-text" value="View Project" />
                          <span>Text</span>
                        </label>
                        <label>
                          <input type="text" name="link-url" value="https://twit96.github.io/minesweeper/" />
                          <span>URL</span>
                        </label>
                        <div class="submit-toggle">
                          <input type="checkbox" name="toggle" />
                          <input name="update" type="submit" value="Update" />
                        </div>
                      </div>
                    </form>
                    <form method="POST" action="admin" enctype="multipart/form-data">
                      <input name="submitted_data" type="hidden" value="link" />
                      <input name="id" type="hidden" value="2" />
                      <div class="label-group">
                        <label>
                          <input type="text" name="link-text" value="View Project" />
                          <span>Text</span>
                        </label>
                        <label>
                          <input type="text" name="link-url" value="https://twit96.github.io/minesweeper/" />
                          <span>URL</span>
                        </label>
                        <div class="submit-toggle">
                          <input type="checkbox" name="toggle" />
                          <input name="update" type="submit" value="Update" />
                        </div>
                      </div>
                    </form>
                    <h5 class="accordion" onclick="this.classList.toggle('active');">Add New Link</h5>
                    <form method="POST" action="admin" enctype="multipart/form-data" class="panel">
                      <input name="submitted_data" type="hidden" value="link" />
                      <div class="label-group">
                        <label>
                          <input type="text" name="link-text" placeholder="Link Text" required />
                          <span>Text</span>
                        </label>
                        <label>
                          <input type="text" name="link-url" placeholder="https://link-url.com/" required />
                          <span>URL</span>
                        </label>
                        <div class="submit-toggle">
                          <input type="submit" name="update" value="Add" style="margin-left: auto;" />
                        </div>
                      </div>
                    </form>
                  </div>  <!-- ./panel -->
                </div>  <!-- ./panel -->
              </div>  <!-- ./panel -->

              <h3 class="accordion" onclick="this.classList.toggle('active');">Add New Project</h3>
              <form method="POST" action="admin" enctype="multipart/form-data" class="panel">
                <input name="submitted_data" type="hidden" value="project" />
                <input name="id" type="hidden" value="15" />
                <input name="author_id" type="hidden" value="1" />
                <div class="label-group">
                  <label><input type="text" name="title" placeholder="New Title" required /><span>Title</span></label>
                  <label><input class="date-today" type="date" name="date" required /><span>Date</span></label>
                </div>
                <div class="label-group">
                  <label><input type="text" name="directory" placeholder="new-directory" required /><span>Directory</span></label>
                  <label><input type="file" name="image" accept="image/png, image/jpg, image/jpeg" required /><span>Image</span></label>
                </div>
                <label><input type="text" name="blurb" placeholder="New Blurb" required /><span>Blurb</span></label>
                <label><textarea name="description" placeholder="New Description" required></textarea><span>Description</span></label>
                <div class="label-group">
                  <input name="link-id" type="hidden" value="1" />
                  <label>
                    <input type="text" name="link-text" placeholder="Link Text" required />
                    <span>Primary Link Text</span>
                  </label>
                  <label>
                    <input type="text" name="link-url" placeholder="https://primary-link.com/" required />
                    <span>Primary Link URL</span>
                  </label>
                </div>
                <div class="label-group">
                  <label><input type="number" name="featured" min="0" value="0" required /><span>Featured</span></label>
                  <div class="submit-toggle"><span></span><input name="update" type="submit" value="Add" /></div>
                </div>
              </form>  <!-- ./panel -->

            </section>

            <section id="edit-posts" class="card">
              <h2>Edit Posts</h2>

              <h3 class="accordion" onclick="this.classList.toggle('active');"><span>(2021-08-01)</span> <span>Post Title 1</span></h3>
              <div class="panel">
                <h4 class="accordion" onclick="this.classList.toggle('active');">Details</h4>
                <form method="POST" action="admin" enctype="multipart/form-data" class="panel">
                  <input name="submitted_data" type="hidden" value="article" />
                  <input name="id" type="hidden" value="1" />
                  <input name="author_id" type="hidden" value="1" />

                  <label>
                    <input type="text" name="title" value="Post Title 1" />
                    <span>Title</span>
                  </label>
                  <div class="label-group">
                    <label>
                      <input type="date" name="date_posted" value="2021-08-01" style="color:var(--grey);" disabled />
                      <span>Date Posted</span>
                    </label>
                    <label>
                      <input type="date" name="date_updated" value="2021-09-01" style="color:var(--grey);" disabled />
                      <span>Last Updated</span>
                    </label>
                  </div>  <!-- ./label-group -->
                  <div class="label-group">
                    <label>
                      <input type="text" name="directory" value="post-title-1" />
                      <span>Directory</span>
                    </label>
                    <label>
                      <input type="file" name="image" accept="image/png, image/jpg, image/jpeg" />
                      <span>Title Image</span>
                    </label>
                  </div>
                  <label>
                    <textarea name="post">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</textarea>
                    <span>Post Content</span>
                  </label>

                  <div class="submit-toggle">
                    <input type="checkbox" name="toggle" />
                    <input name="update" type="submit" value="Update" />
                  </div>  <!-- ./submit-toggle -->
                </form>

                <h4 class="accordion" onclick="this.classList.toggle('active');">Tags</h4>
                <div class="panel">
                  <form method="POST" action="admin" enctype="multipart/form-data">
                    <input name="submitted_data" type="hidden" value="tag" />
                    <input name="id" type="hidden" value="2" />
                    <input name="post_id" type="hidden" value="2" />
                    <div class="label-group">
                      <label>
                        <input type="text" name="name" value="Tag 1" />
                        <span>Tag</span>
                      </label>
                      <div class="submit-toggle">
                        <input name="update" type="submit" value="Delete" class="active" style="margin-left: auto;" />
                      </div>
                    </div>
                  </form>
                  <form method="POST" action="admin" enctype="multipart/form-data">
                    <input name="submitted_data" type="hidden" value="tag" />
                    <input name="id" type="hidden" value="2" />
                    <div class="label-group">
                      <label>
                        <input type="text" name="tag" value="Tag 1" />
                        <span>Tag</span>
                      </label>
                      <div class="submit-toggle">
                        <input name="update" type="submit" value="Delete" class="active" style="margin-left: auto;" />
                      </div>
                    </div>
                  </form>
                  <h5 class="accordion" onclick="this.classList.toggle('active');">Add New Tag</h5>
                  <form method="POST" action="admin" enctype="multipart/form-data" class="panel">
                    <input name="submitted_data" type="hidden" value="tag" />
                    <div class="label-group">
                      <label>
                        <input type="text" name="link-text" placeholder="Tag Name" required />
                        <span>Tag</span>
                      </label>
                      <div class="submit-toggle">
                        <input type="submit" name="update" value="Add" style="margin-left: auto;" />
                      </div>
                    </div>
                  </form>
                </div>  <!-- ./panel -->
              </div>  <!-- ./panel -->

              <h3 class="accordion" onclick="this.classList.toggle('active');">Create New Post</h3>
              <form method="POST" action="admin" enctype="multipart/form-data" class="panel">
                <input name="submitted_data" type="hidden" value="article" />
                <input name="id" type="hidden" value="15" />
                <input name="author_id" type="hidden" value="1" />
                <div class="label-group">
                  <label><input type="text" name="title" placeholder="New Title" required /><span>Title</span></label>
                  <label><input class="date-today" type="date" name="date_posted" /><span>Date Posted</span></label>
                </div>
                <div class="label-group">
                  <label><input type="text" name="directory" placeholder="new-directory" required /><span>Directory</span></label>
                  <label><input type="file" name="image" accept="image/png, image/jpg, image/jpeg" required /><span>Image</span></label>
                </div>
                <label><textarea name="post" placeholder="New Post" required></textarea><span>Post</span></label>
                <div class="submit-toggle"><span></span><input name="update" type="submit" value="Add" /></div>
              </form>  <!-- ./panel -->

              <script src="/js/admin.js"></script>
            </section>
          </div>  <!-- ./left -->
          <div class="right">

            <div id="user-profile" class="card">
              <div class="btn-container">
                <button class="btn-text edit">
                  <span class="icon"></span>
                  <span>Edit</span>
                </button>
              </div>
              <div class="flex">
                <div class="left">
                  <div class="profile-box">
                    <img class="profile" src="/img/profile.jpg" alt="Profile Image" />
                  </div>
                  <span class="role">Admin</span>
                </div>  <!-- ./left -->
                <ul class="right">
                  <li><b>Tyler Wittig</b></li>
                  <li>
                    <a class="btn-text internet" href="#">
                      <span class="icon"></span>
                      <span>tylerwittig.com</span>
                    </a>
                  </li>
                  <li>
                    <a class="btn-text mail" href="#">
                      <span class="icon"></span>
                      <span>tylerwittig@utexas.edu</span>
                    </a>
                  </li>
                </ul>  <!-- ./right -->
              </div>  <!-- ./flex -->
            </div>  <!-- #/user-profile -->

            <div id="user-profile" class="card">
              <div class="btn-container">
                <button>Save</button>
                <button class="x-btn">X</button>
              </div>
              <div class="flex">
                <div class="left">
                  <div class="profile-box">
                    <input id="profile-file" type="file" accept="image/png, image/jpg, image/jpeg" style="display: none;" />
                    <input type="button" value="+" onclick="document.getElementById('profile-file').click();" />
                    <img class="profile" src="/img/profile.jpg" alt="Profile Image" />
                  </div>
                  <span class="role">Admin</span>
                </div>  <!-- ./left -->
                <div class="right">
                  <div class="label-group">
                    <label>
                      <input type="text" name="fname" value="Tyler" />
                      <span>First Name</span>
                    </label>
                    <label>
                      <input type="text" name="lname" value="Wittig" />
                      <span>Last Name</span>
                    </label>
                  </div>
                  <label>
                    <input type="text" name="website" value="tylerwittig.com" />
                    <span>Website</span>
                  </label>
                  <label>
                    <input type="text" name="email" value="tylerwittig@utexas.edu" />
                    <span>Email</span>
                  </label>
                  <div class="label-group">
                    <label>
                      <input type="text" name="uname" value="wittig_" />
                      <span>Username</span>
                    </label>
                    <label>
                      <input type="password" name="pword" value="Myname1596!" />
                      <span>Password</span>
                    </label>
                  </div>  <!-- ./label-group -->
                </div>  <!-- ./right -->
              </div>  <!-- ./flex -->
            </div>  <!-- #/user-profile -->

          </div>  <!-- ./right -->
        </div>  <!-- ./flex -->
      </div>  <!-- ./wrapper -->
    </main>

    <footer>
      <div class="wrapper">
        <div class="info">
          <img class="logo" src="/img/profile.jpg" alt="Profile Image"/>
          <span><em>Tyler Wittig</em> | Web Developer</span>
        </div>
        <div class="links">
          <nav>
            <a href="/">Home</a>
            <a href="/projects">Projects</a>
            <a href="/admin">Admin</a>
          </nav>
          <div class="socials">
            <div>
              <a class="social-icon" href="mailto:tylerwittig@utexas.edu?subject=Web%20Developer%20Information" target="_blank" rel="noreferrer">
                <img src="/img/logo_email.png" alt="twitter logo" />
              </a>
              <a class="social-icon" href="https://github.com/twit96" target="_blank" rel="noreferrer">
                <img src="/img/logo_github.png" alt="github logo" />
              </a>
              <a class="social-icon" href="https://www.linkedin.com/in/tylerwittig/" target="_blank" rel="noreferrer">
                <img src="/img/logo_linkedin.png" alt="linkedin logo" />
              </a>
              <!-- <a class="social-icon" href="https://twitter.com/tyler_wittig" target="_blank" rel="noreferrer">
                <img src="/img/logo_twitter.png" alt="twitter logo" />
              </a> -->
            </div>
            <a class="resume" href="/20211003-résumé-tylerwittig.pdf">
              Download my Résumé
            </a>
          </div>  <!-- ./socials -->
        </div>  <!-- ./links -->
        <span>&copy; 2021 Tyler Wittig</span>
      </div>
    </footer>
  </body>
</html>