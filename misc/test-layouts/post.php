<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>Post</title>
    <meta name="description" content="Post" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#ffffff" />
    <link rel="icon" href="/img/icon.png" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/main.css" />
    <script src="/js/main.js" defer></script>
    <link rel="stylesheet" type="text/css" href="/css/articles.css" />
  </head>
  <body>

    <?php
      DEFINE("FILENAME", 'post');
      include('../../includes/templates/header.php');
    ?>

    <main id="post">
      <div class="wrapper">

        <article>
          <div class="card details" style="background-image: url(/img/projects/first-portfolio/title-card.png)">
            <h1>First Portfolio Website is First is First</h1>
            <ul class="tags">
              <li><a href="#">Web Game</a></li>
              <li><a href="#">JavaScript</a></li>
              <li><a href="#">Grid Traversal</a></li>
              <li><a href="#">Responsive</a></li>
            </ul>
            <div class="author">
              <img src="/img/profile.jpg"/>
              <p>
                <b>Tyler Wittig</b> on <span>2020-09-01</span> (Updated on <span>2021-11-06)</span>
              </p>
            </div>
            <div class="btm-border"></div>
          </div>  <!-- ./card details -->
          <div class="card">
            <h2>Did you know this?</h2>
            <p>
              Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
              eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut
              enim ad minim veniam, quis nostrud exercitation ullamco laboris
              nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in
              reprehenderit in voluptate velit esse cillum dolore eu fugiat
              nulla pariatur. Excepteur sint occaecat cupidatat non proident,
              sunt in culpa qui officia deserunt mollit anim id est laborum.
            </p>
            <h3>Here is some code about it</h3>

<pre><code>#title-img {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100vh;
  opacity: 0.75;
  z-index: -1;
}

#title-img::after {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-image: radial-gradient(ellipse, transparent, var(--green) 75%);
}</code></pre>
            <h4>Here is the code explanation</h4>
            <p>
              Velit laoreet id donec ultrices tincidunt arcu non sodales neque.
              Tempor orci dapibus ultrices in iaculis nunc. Sit amet
              consectetur adipiscing elit. Lectus magna fringilla urna
              porttitor rhoncus. Diam maecenas sed enim ut sem. Nibh tellus
              molestie nunc non blandit massa enim. Ultricies lacus sed turpis
              tincidunt. Volutpat lacus laoreet non curabitur gravida arcu ac.
              At imperdiet dui accumsan sit amet nulla facilisi morbi tempus.
            </p>
            <figure>
              <img src="/img/projects/first-portfolio/title-card.png" alt="Post Title Card" />
              <figcaption>This is an image within a figure</figcaption>
            </figure>
            <h3>So what is next?</h3>
            <p>
              Faucibus a pellentesque sit amet porttitor eget dolor morbi non.
              Purus in massa tempor nec feugiat. Arcu cursus euismod quis
              viverra nibh cras. Id semper risus in hendrerit. Porttitor leo a
              diam sollicitudin tempor id eu. Egestas integer eget aliquet nibh
              praesent tristique magna. Tristique senectus et netus et malesuada
              fames ac turpis egestas. Est lorem ipsum dolor sit amet. Mattis
              vulputate enim nulla aliquet porttitor lacus. Diam maecenas sed
              enim ut sem viverra aliquet.
            </p>
            <h4>Should we do that?</h4>
            <p>
              Ornare arcu odio ut sem nulla. Dolor sit amet consectetur
              adipiscing elit ut aliquam purus sit. Sit amet luctus venenatis
              lectus magna fringilla urna porttitor. Ipsum dolor sit amet
              consectetur. Justo laoreet sit amet cursus sit amet dictum sit.
              At erat pellentesque adipiscing commodo elit at imperdiet dui.
              Quis ipsum suspendisse ultrices gravida. Est ullamcorper eget
              nulla facilisi etiam. Consequat semper viverra nam libero justo
              laoreet sit amet cursus.
            </p>
            <h5>Pros</h5>
            <p>
              Adipiscing elit ut aliquam purus.
              Adipiscing elit duis tristique sollicitudin nibh sit amet
              commodo. Mollis aliquam ut porttitor leo a diam sollicitudin.
              Consectetur lorem donec massa sapien faucibus et molestie ac.
              Volutpat lacus laoreet non curabitur gravida arcu ac. Dolor sit
              amet consectetur adipiscing elit. Vitae ultricies leo integer
              malesuada nunc.
            </p>
            <h6>Pro 1</h6>
            <p>
              Ultrices gravida dictum fusce ut placerat orci nulla.
              Adipiscing tristique risus nec feugiat in fermentum posuere urna.
              Sed velit dignissim sodales ut eu sem. Faucibus a pellentesque
              sit amet. A lacus vestibulum sed arcu non odio.
            </p>
            <h6>Pro 2</h6>
            <p>
              Accumsan lacus vel facilisis volutpat est. Quis commodo odio
              aenean sed adipiscing diam donec adipiscing tristique. Netus et
              malesuada fames ac turpis. Faucibus et molestie ac feugiat sed
              lectus.
            </p>
            <h6>Pro 3</h6>
            <p>
              Quis vel eros donec ac odio. Enim ut sem viverra aliquet eget sit
              amet. Molestie ac feugiat sed lectus. Lobortis elementum nibh
              tellus molestie nunc non. Augue mauris augue neque gravida in
              fermentum.
            </p>
            <h5>Cons</h5>
            <p>
              Tristique sollicitudin nibh sit amet commodo nulla
              facilisi nullam. Mauris in aliquam sem fringilla ut morbi
              tincidunt. Ultrices dui sapien eget mi proin. Ultricies lacus sed
              turpis tincidunt id aliquet risus feugiat in. Molestie ac feugiat
              sed lectus vestibulum mattis.
            </p>
            <h6>Con 1</h6>
            <p>
              Hendrerit dolor magna eget est. Lorem ipsum dolor sit amet
              consectetur. Varius vel pharetra vel turpis nunc eget lorem. Quam
              lacus suspendisse faucibus interdum posuere lorem ipsum dolor.
            </p>
            <h6>Con 2</h6>
            <p>
              Magna fermentum iaculis eu non diam phasellus vestibulum lorem.
              Dictum fusce ut placerat orci. Lectus sit amet est placerat in
              egestas erat imperdiet.
            </p>
            <h6>Con 3</h6>
            <p>
              Mattis ullamcorper velit sed ullamcorper morbi tincidunt ornare
              massa. Nullam vehicula ipsum a arcu cursus vitae congue mauris
              rhoncus. Et leo duis ut diam quam nulla porttitor massa.
            </p>
            <h3>What others know about it</h3>
            <p>
              Tincidunt praesent semper feugiat nibh sed pulvinar. Enim ut
              tellus elementum sagittis vitae et leo duis. Morbi tristique
              senectus et netus et malesuada fames ac. Fames ac turpis egestas
              sed tempus urna et pharetra. Nibh praesent tristique magna sit
              amet purus gravida quis blandit. Et malesuada fames ac turpis
              egestas integer. In hac habitasse platea dictumst vestibulum
              rhoncus. Aliquam sem fringilla ut morbi tincidunt augue interdum
              velit euismod. Vitae nunc sed velit dignissim sodales ut eu.
            </p>
            <h2>A similar problem</h2>
            <p>
              Elementum nibh tellus molestie nunc non blandit massa enim nec.
              Urna duis convallis convallis tellus id interdum velit. Lacus
              luctus accumsan tortor posuere ac ut.
            </p>
            <h3>What others know about it</h3>
            <p>
              Quam pellentesque nec nam aliquam sem. Amet commodo nulla
              facilisi nullam vehicula ipsum a. Pellentesque diam volutpat
              commodo sed egestas egestas fringilla phasellus faucibus.
              Consequat nisl vel pretium lectus. Iaculis nunc sed augue lacus.
            </p>
            <h3>It has an easier solution</h3>
            <p>
              Massa massa ultricies mi quis. Ac placerat vestibulum lectus
              mauris ultrices eros in cursus. Lectus arcu bibendum at varius
              vel. Pharetra pharetra massa massa ultricies mi quis hendrerit.
              Faucibus ornare suspendisse sed nisi.
            </p>
            <h2>In Conclusion</h2>
            <p>
              Netus et malesuada fames ac turpis egestas integer eget aliquet.
              Hendrerit gravida rutrum quisque non tellus orci ac auctor. Urna
              nunc id cursus metus aliquam eleifend mi in. Non arcu risus quis
              varius quam. Mauris cursus mattis molestie a iaculis at erat. In
              mollis nunc sed id semper risus in hendrerit. Dui accumsan sit
              amet nulla facilisi morbi tempus iaculis urna. Nisl rhoncus
              mattis rhoncus urna. Eget duis at tellus at urna. Orci sagittis
              eu volutpat odio facilisis. Ipsum dolor sit amet consectetur
              adipiscing. Tempor id eu nisl nunc mi ipsum.
            </p>
          </div>  <!-- ./card -->
        </article>

        <div id="sidebar">
          <div id="toc" class="card">
            <div id="toc-toggle"><span></span></div>
            <h3>Table of Contents</h3>
            <nav></nav>
          </div>
          <div id="toc-bg"></div>
          <script src="/js/toc.js" defer></script>
          <div class="card">
            <p>
              We’re all familiar with the concept of autocompletion, right?
              You type something into a search box and it tries to guess what
              you’re looking for as you type, displaying suggestions, often
              below the cursor.
            </p>
            <p>
              While we’re used to autocomplete on eCommerce
              sites that redirect to search or product pages, an underrated
              usage is when used as a secondary search pattern to augment the
              typing experience.
            </p>
          </div>
        </div>  <!-- #/sidebar -->

      </div>  <!-- ./wrapper -->
    </main>

    <?php
      include('../../includes/templates/footer.php');
    ?>
  </body>
</html>
