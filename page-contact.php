<?php
/*
Template Name: Contact
*/
?>

<?php
if(isset($_POST['submitted'])) {
    if(trim($_POST['contactName']) === '') {
        $nameError = 'Please enter your name.';
        $hasError = true;
    } else {
        $fullName = trim($_POST['contactName']);
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

    $subject = trim($_POST['subject']);

    if(!isset($hasError)) {
        $emailTo = get_option('tz_email');
        if (!isset($emailTo) || ($emailTo == '') ){
            $emailTo = 'hello@codeliberation.org';
        }
        $subject = 'Contact Form Submission: '.$subject;
        $body = "Name: $fullName \n\nEmail: $email \n\n$subject \n\nComments: $comments";
        $headers = 'From: '.$fullName.' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;

        wp_mail($emailTo, $subject, $body, $headers);
        $emailSent = true;
    }

} ?>

<?php get_header(); ?>

<div id="content">
	<div id="inner-content" class="wrap clearfix contact-us">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<section class="hero">
				<?php the_content(); ?>
			</section>
		<?php endwhile; endif; ?>
        

     <div id="contact-form" class="hero">
            <?php if(isset($emailSent) && $emailSent == true) { ?>
                <div id="email-success">
                    <h4>Thanks, your email was sent successfully.</h4>
                </div>
            <?php } else { ?>

                    <div class="entry-content">
                        <form action="<?php the_permalink(); ?>" id="contactForm" method="post">
                            <ul>
                                <li>
                                    <label for="contactName">Name</label>
                                    <input type="text" name="contactName" id="contactName" value="<?php echo $fullName; ?>" placeholder="enter your first and last name" />
												<?php if ($nameError) {
												echo '<p class="alert-error">'.$nameError.'</p>';
												}
												?>
                                </li>
                                <li>
                                    <label for="email">Email address</label>
                                    <input type="text" name="email" id="email" value="<?php echo $email; ?>" placeholder="email@address.com" />
												<?php if ($emailError) {
												echo '<p class="alert-error">'.$emailError.'</p>';
												}
												?>
                                </li>
                                <li>
                                    <label for="subject">Subject</label>
                                    <input type="text" name="subject" id="subject" value="<?php echo $_POST['subject']; ?>" placeholder="enter a subject here" />
                                </li>
                                <li>
                                    <label for="commentsText">Message</label>
                                    <textarea name="comments" id="commentsText" rows="7" cols="55" placeholder="enter your message"><?php echo $comments; ?></textarea>
												<?php if ($commentError) {
												echo '<p class="alert-error">'.$commentError.'</p>';
												}
												?>
                                </li>
                                <li>
                                    <button type="submit" class="button">Send us your message!</button>
                                </li>
                            </ul>
                            <input type="hidden" name="submitted" id="submitted" value="true" />
                        </form>
                    </div>
            <?php } ?>
    </div><!-- #content -->
</div>

<?php get_footer(); ?>