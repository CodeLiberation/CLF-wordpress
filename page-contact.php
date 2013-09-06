<?php
/*
Template Name: Contact
*/
?>

<?php
if(isset($_POST['submitted'])) {
    if(trim($_POST['contactFirstName']) === '') {
        $nameError = 'Please enter your name.';
        $hasError = true;
    } else {
        $name = trim($_POST['contactFirstName']);
    }

    if(trim($_POST['email']) === '')  {
        $emailError = 'Please enter your email address.';
        $hasError = true;
    } else if (!preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", trim($_POST['email']))) {
        $emailError = 'You entered an invalid email address.';
        $hasError = true;
    } else {
        $email = trim($_POST['email']);
    }

    if(trim($_POST['comments']) === '') {
        $commentError = 'Please enter a message.';
        $hasError = true;
    } else {
        if(function_exists('stripslashes')) {
            $comments = stripslashes(trim($_POST['comments']));
        } else {
            $comments = trim($_POST['comments']);
        }
    }

    if(!isset($hasError)) {
        $emailTo = get_option('tz_email');
        if (!isset($emailTo) || ($emailTo == '') ){
            $emailTo = get_option('admin_email');
        }
        $subject = '[PHP Snippets] From '.$name;
        $body = "Name: $name \n\nEmail: $email \n\nComments: $comments";
        $headers = 'From: '.$name.' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;

        wp_mail($emailTo, $subject, $body, $headers);
        $emailSent = true;
    }

} ?>

<?php get_header('contact'); ?>

<div id="content">
     <div id="about-content-top">
        We can answer general questions as well as inquiries about classes, events, tutoring and workshops.
     </div>

     <div id="contact-form">
        <?php the_post() ?>
        <div id="post-<?php the_ID() ?>" class="post">
            <div class="entry-content">
                <form action="<?php the_permalink(); ?>" id="contactForm" method="post">
                    <ul>
                        <li>
                            <label for="contactFirstName">First Name:</label>
                            <input type="text" name="contactFirstName" id="contactFirstName" value="" />
                            <label for="contactLastName">Last Name:</label>
                            <input type="text" name="contactLastName" id="contactLastName" value="" />
                        </li>
                        <li>
                            <label for="email">Email</label>
                            <input type="text" name="email" id="email" value=""/>
                        </li>
                        <li>
                            <label for="subjectText">Subject:</label>
                            <textarea name="subject" id="subjectText" rows="7" cols="75"></textarea>
                        </li>
                        <li>
                            <label for="commentsText">Message:</label>
                            <textarea name="comments" id="commentsText" rows="7" cols="75"></textarea>
                        </li>
                        <li>
                            <button type="submit">Send us your message!</button>
                        </li>
                    </ul>
                    <input type="hidden" name="submitted" id="submitted" value="true" />
                </form>
            </div><!-- .entry-content ->
        </div><!-- .post-->
    </div>

</div>

<?php get_footer(); ?>