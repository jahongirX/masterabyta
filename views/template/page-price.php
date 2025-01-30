<?php /* Template name: Price */ ?>
<?php get_header(); ?>

    <div class="container banner banner-main" style="height: inherit;">
        <div class="row">
            <div class="banner-content">
                <div class="banner-header">
                    <p>«Муж на час» — любая помощь по дому!<br>Выполним работу быстро, качественно и<br> недорого!
                        Стоимость услуг от 200 рублей!</p>
                </div>
				<div id="banner-advantages">
					<div class="advantages-icons">
						<p class="advantage-1"><span>Любой мелкий ремонт и другие задачи по дому</span></p>
						<p class="advantage-2"><span>Приедем в течение часа или в удобное время</span></p>
						<p class="advantage-3"><span>Выезд мастера - бесплатно<br/>Работаем круглосуточно!</span></p>
						<p class="advantage-4"><span>Низкие цены на услуги<br />Гарантия до 1 года</span></p>
					</div>
				</div>
                <div id="banner-form-wrapper">
                    <?php
                        $forms = get_posts("post_type=wpcf7_contact_form&showposts=-1");
                        foreach($forms as $form){
                            if($form->post_title=="Заявка в заставке"){
                                echo do_shortcode('[contact-form-7 id="'.$form->ID.'"]');
                            }
                        }
                    ?>
                </div>
                <div class="banner-discount">
                    <p>Скидки на услуги до 20%</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container content">
        <div class="row">
            <div class="three-mod columns">

                <?php get_sidebar(); ?>

            </div>
            <div class="nine-mod columns">


                <?php if(get_town()=="Москва"): ?>
                <h1><?php echo do_shortcode(get_the_title()); ?></h1>
                <?php the_content(); ?>
                <?php else: ?>
                    <?php if(get_field("content-two-title-on")): ?>
                        <h1><?php echo do_shortcode(get_field("content-two-title")); ?></h1>
                        <?php else: ?>
                            <h1><?php echo do_shortcode(get_the_title()); ?></h1>
                        <?php endif; ?>

                    <?php if(get_field("content-two-on")): ?>
                        <?php the_field("content-two"); ?>
                        <?php else: ?>
                            <?php the_content(); ?>
                        <?php endif; ?>                    
                <?php endif; ?>


            </div>
        </div>
    </div>

<?php get_footer();
