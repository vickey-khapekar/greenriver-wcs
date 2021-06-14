<?php
/*
  Template Name: Waterworks Operator Change of lnformation Form
 */
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package bento
 */
get_header();
?>
<div class="site-main">
    <!-- Banner -->
    <?php if( have_rows('hero_banner') ): ?>
    <div class="container-fluid main-banner mhB-225 banner banner-margin">
        <?php while( have_rows('hero_banner') ): the_row(); 
        $heroBannerBGImg = get_sub_field('hero_banner_background_image');
        $heroBannerTitle = get_sub_field('hero_banner_title');
      ?>
        <div class="banner-img"
            style="background: url('<?php echo $heroBannerBGImg['url']; ?>') no-repeat center/ cover;">
        </div>
        <div class="container">
            <div class="row banner-content mhB-225">
                <div class="page-title-wrap py-4">
                    <h1 class="page-title text-white">
                        <?php if($heroBannerTitle): echo $heroBannerTitle; else: echo get_the_title(); endif; ?></h1>
                </div>
            </div>
        </div>

        <?php endwhile; ?>
    </div><!-- /. Banner -->
    <?php endif; ?>
    <?php $category = get_the_category();
            $category_parent_id = $category[0]->category_parent;
            $category_parent = get_category($category_parent_id);
           ?>

    <!-- Breadcrumb -->
    <div class="container-fluid breadcrumb_outer bg-f5 pt-4 pb-3">
        <div class="container">
            <div class="row breadcrumb_wrap d-flex justify-content-start align-items-center">
                <!-- <span>You are here :</span> -->
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item bold"><a href="<?php echo site_url(); ?>">WCS</a></li>
                        <li class="breadcrumb-item bold"><a
                                href="<?php echo site_url(); ?>/<?php echo $category_parent->slug;?>"><?php echo $category_parent->name;?></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo get_the_title();?></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div><!-- /. Breadcrumb -->

    <!-- Main Content -->
    <div class="container-fluid bg-f5 py-3 px-0">
        <div class="container">
            <div class="row flex-row-reverse text-grey pb-5">
                <div class="col-12 col-md-8 col-lg-9">

                    <?php if( have_rows('wwo-layouts') ): ?>
                    <?php while( have_rows('wwo-layouts') ): the_row(); ?>
                    <?php if( get_row_layout() == 'm01-text_content' ): ?>
                    <?php the_sub_field('content'); ?>

                    <?php elseif( get_row_layout() == 'm02-title' ): 
                    $m02TitleWrapClass = get_sub_field('m02-title_wrap_class');
                    $m02Title = get_sub_field('m02-title');
                    ?>
                    <div
                        class="<?php if($m02TitleWrapClass): echo $m02TitleWrapClass; else: echo 'sec-title-wrap'; endif;?>">
                        <?php //echo $m02Title; ?>
                    </div>

                    <?php elseif( get_row_layout() == 'm03-single_image' ): 
                        $m03SingleImage = get_sub_field('m03-single_image');
                        $m03ImageWrapperClass = get_sub_field('m03-image_wrapper_class');
                        $m03ImageClass = get_sub_field('m03-image_class');
                        ?>
                    <?php if($m03ImageWrapperClass): ?>
                    <div class="<?php echo $m03ImageWrapperClass; ?>">
                        <?php endif; ?>
                        <img class="<?php if($m03ImageClass): echo $m03ImageClass; else: echo 'img-fluid'; endif; ?>"
                            src="<?php echo esc_url( $m03SingleImage['url'] ); ?>"
                            alt="<?php echo esc_attr( $m03SingleImage['alt'] ); ?>" />
                        <?php if($m03ImageWrapperClass): ?>
                    </div>
                    <?php endif; ?>

                    <?php elseif( get_row_layout() == 'm04-include_the_content' ): 
                            $m04isTheContentNeeded = get_sub_field('m04-is_the_content_needed');

                            if($m04isTheContentNeeded == 'yes'):
                                if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

                    <?php the_content(); ?>

                    <?php
                                    endwhile; ?>
                    <?php endif; 

                            endif;
                            ?>

                    <?php elseif( get_row_layout() == 'm05-accordion' ): 
                            $m05AccordionID = get_sub_field('m05-accordion_id');
                            ?>
                    <?php if( have_rows('m05-accordion_items') ): ?>
                    <?php $accItemCount = 1; ?>
                    <div class="prime-accordion"
                        id="<?php if($m05AccordionID): echo $m05AccordionID; else: echo 'accordion-renewal'; endif; ?>">
                        <?php while( have_rows('m05-accordion_items') ): the_row(); 
                                    $M05AccordionTitle = get_sub_field('M05-accordion_title');
                                    $m05AccordionContent = get_sub_field('m05-accordion_content');
                                    ?>
                        <div class="card">
                            <div class="card-header"
                                id="<?php echo $m05AccordionID; ?>heading<?php echo $accItemCount; ?>">
                                <h4 class="mb-0">
                                    <button class="btn btn-link" aria-expanded="false" data-toggle="collapse"
                                        data-target="#<?php echo $m05AccordionID; ?>collapse<?php echo $accItemCount; ?>"
                                        aria-expanded="true"
                                        aria-controls="<?php echo $m05AccordionID; ?>collapse<?php echo $accItemCount; ?>">
                                        <?php echo $M05AccordionTitle; ?>
                                    </button>
                                </h4>
                            </div>

                            <div id="<?php echo $m05AccordionID; ?>collapse<?php echo $accItemCount; ?>"
                                class="card-body-wrap collapse"
                                aria-labelledby="<?php echo $m05AccordionID; ?>heading<?php echo $accItemCount; ?>"
                                data-parent="#<?php echo $m05AccordionID; ?>">
                                <div class="card-body">
                                    <?php echo $m05AccordionContent; ?>
                                </div>
                            </div>
                        </div>
                        <?php $accItemCount++; ?>
                        <?php endwhile; ?>
                    </div>
                    <script>
                    (function($) {
                        $(document).ready(function() {
                            $('.prime-accordion .card:first-child .card-header button').attr(
                                'aria-expanded', 'true');
                            $('.prime-accordion .card:first-child .card-body-wrap').addClass('show');
                        });
                    })(jQuery)
                    </script>
                    <?php endif; ?>
                    <?php elseif( get_row_layout() == 'm06-info_grid' ): 
                            ?>
                    <?php if( have_rows('m06-info_grid_row') ): ?>
                    <div class="d-flex flex-wrap align-items-center">
                        <?php while( have_rows('m06-info_grid_row') ): the_row(); 
                                    $m06ColumnMainClass = get_sub_field('m06-column_main_class');
                                    $m06Title = get_sub_field('m06-title');
                                    $m06LeftButton = get_sub_field('m06-left_button');
                                    $m06LeftButtonClass = get_sub_field('m06-left_button_class');
                                    $m06RightButton = get_sub_field('m06-right_button');
                                    $m06RightButtonClass = get_sub_field('m06-right_button_class');
                                    $m06TopRightButton = get_sub_field('m06-top_right_button');
                                    $m06TopRightButtonClass = get_sub_field('m06-top_right_button_class');
                                    ?>
                        <div
                            class="<?php if($m06ColumnMainClass): echo $m06ColumnMainClass; else: echo 'col-md-12 col-lg-6 col-xl-4 px-1 py-2'; endif;?>">
                            <div class="card-default-bg card w-100 bg-form text-white text-center">
                                <div class="card-body">
                                    <?php if($m06TopRightButton): ?>
                                    <div class="top-btn-wrappers">
                                        <br>
                                        <?php if($m06TopRightButton): 
                                                    $m06TopRightButton_url = $m06TopRightButton['url'];
                                                    $m06TopRightButton_title = $m06TopRightButton['title'];
                                                    $m06TopRightButton_target = $m06TopRightButton['target'] ? $m06TopRightButton['target'] : '_self';
                                                    ?>
                                        <a class="<?php if($m06TopRightButtonClass): echo $m06TopRightButtonClass; else: echo 'card-link font18 web-fill-in-btn'; endif;?>"
                                            href="<?php echo esc_url( $m06TopRightButton_url ); ?>"
                                            target="<?php echo esc_attr( $m06TopRightButton_target ); ?>">
                                            <?php echo esc_html( $m06TopRightButton_title ); ?>
                                        </a>
                                        <?php endif; ?>
                                    </div>
                                    <?php endif; ?>

                                    <div
                                        class="card-text-wrap <?php if(!$m06TopRightButton): echo 'margin-force-center'; endif; ?>">


                                        <?php if($m06Title): echo $m06Title; endif; ?>
                                    </div>

                                    <?php if($m06LeftButton || $m06RightButton):?>
                                    <div class="btn-wrappers">
                                        <?php if($m06LeftButton): 
                                                        $m06LeftButton_url = $m06LeftButton['url'];
                                                        $m06LeftButton_title = $m06LeftButton['title'];
                                                        $m06LeftButton_target = $m06LeftButton['target'] ? $m06LeftButton['target'] : '_self';
                                                        ?>
                                        <a class="<?php if($m06LeftButtonClass): echo $m06LeftButtonClass; else: echo 'card-link font18 fill-in-btn'; endif;?>"
                                            href="<?php echo esc_url( $m06LeftButton_url ); ?>"
                                            target="<?php echo esc_attr( $m06LeftButton_target ); ?>">
                                            <?php echo esc_html( $m06LeftButton_title ); ?>
                                        </a>
                                        <?php endif; ?>

                                        <br>

                                        <?php if($m06RightButton): 
                                                        $m06RightButton_url = $m06RightButton['url'];
                                                        $m06RightButton_title = $m06RightButton['title'];
                                                        $m06RightButton_target = $m06RightButton['target'] ? $m06RightButton['target'] : '_self';
                                                        ?>
                                        <a class="<?php if($m06RightButtonClass): echo $m06RightButtonClass; else: echo 'card-link font18 fill-in-btn'; endif;?>"
                                            href="<?php echo esc_url( $m06RightButton_url ); ?>"
                                            target="<?php echo esc_attr( $m06RightButton_target ); ?>">
                                            <?php echo esc_html( $m06RightButton_title ); ?>
                                        </a>
                                        <?php endif; ?>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php endwhile; ?>
                    </div>
                    <?php endif; ?>
                    <?php endif; ?>
                    <?php endwhile; ?>
                    <?php endif; ?>                      
              
                  <p>Certified waterworks operators must submit this form to notify Department of Health and Washington Certification Services of changes to their contact information. Only a home address will be accepted as the mailing address of record. The Waterworks Operator Certification Program will not consider an appeal from an operator that is assessed a renewal late fee, does not renew a certificate, or does not meet the professional growth requirement due to failure to provide a valid home and email address.</p>
                  <form  method="post" novalidate="novalidate">
                  <div class="col-12 pt-4">
                    <div class="sec-title-wrap d-block">
                        <h2 class="sec-title c-prime font-segoe-sb">
                            Required Verification Information
                        </h2>
                    </div>  </div>
                    
                        <div class="form-group row">
                            <div class="col-lg-8 col-md-12 col-sm-12">
                                <label for="ww-cert-no" class="pl-3 col-form-label labelAlign required">Waterworks Certification Number
                                </label>
                             <input type="number" class="form-control" id="ww-cert-no" name="ww-cert-no">
                             <span id="ww-cert-no-info" class="text-danger float-right"></span>
                             
                            </div>
                            
                          </div>
                          <div class="form-group row">
                 
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <label for="firstname" class="pl-3 col-form-label labelAlign required">First Name
                                </label>
                             <input type="text" class="form-control" id="firstname" name="firstname">
                             <span id="firstname-info" class="text-danger float-right"></span>
                             
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <label for="lastname" class="pl-3 col-form-label labelAlign required">Last Name
                                </label>
                             <input type="text" class="form-control" id="lastname" name="lastname">
                             <span id="lastname-info" class="text-danger float-right"></span>
                             
                            </div>
                          </div>
                          
  
                     
                      
                   
                              <div class="form-group col-lg-12">
                                <div class="form-check ">
                                    <input type="checkbox" class="form-check-input" id="DeclarationAgree" name="DeclarationAgree" value="DeclarationAgree">
                                    <label class="form-check-label" for="DeclarationAgree"> I certify that I am the operator identified above and I authorize Department of Health and Washington Certification Services to make these changes to my contact information. I understand that third parties, such as employers, are prohibited from submitting changes</label>
                                </div>
                                <label id="DeclarationAgree-info" for="DeclarationAgree" class="text-danger d-none-hide">Please Agree</label>
                            </div>
                            <div class="col-12">
                                <hr>
                            </div>
                            <div class="col-12 pt-4">
                                <div class="sec-title-wrap d-block">
                                    <h2 class="sec-title c-prime font-segoe-sb">
                                        Change Operator Information
                                    </h2>
                                </div>  </div>
                                <strong>Enter only the information that has changed.
                                </strong>
                                <div class="form-group row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <label for="changedaddress" class="pl-3 col-form-label labelAlign ">Home Mailing Address
                                        </label>
                                     <input type="text" class="form-control" id="changedaddress" name="changedaddress">
                                     <span id="changedaddress-info" class="text-danger float-right"></span>
                                     
                                    </div>
                                  
                                  </div>
                                  <div class="form-group row">
                                    <div class="col-lg-4 col-md-12 col-sm-12">
                                        <label for="changedcity" class="pl-3 col-form-label labelAlign ">City
                                        </label>
                                     <input type="text" class="form-control" id="changedcity" name="changedcity">
                                     <span id="changedcity-info" class="text-danger float-right"></span>
                                     
                                    </div>
                                    <div class="col-lg-4 col-md-12 col-sm-12">
                                        <label for="changedstate" class="pl-3 col-form-label labelAlign ">State
                                        </label>
                                     <input type="text" class="form-control" id="changedstate" name="changedstate">
                                     <span id="changedstate-info" class="text-danger float-right"></span>
                                     
                                    </div>
                                    <div class="col-lg-4 col-md-12 col-sm-12">
                                        <label for="changedzipcode" class="pl-3 col-form-label labelAlign ">Zip Code
                                        </label>
                                     <input type="number" class="form-control" id="changedzipcode" name="changedzipcode">
                                     <span id="changedzipcode-info" class="text-danger float-right"></span>
                                     
                                    </div>
                                  
                                  </div>
                                  <div class="form-group row">
                                    <div class="col-lg-6 col-md-12 col-sm-12">
                                        <label for="personal-mail" class="pl-3 col-form-label labelAlign ">Personal Mail
                                        </label>
                                     <input type="email" class="form-control" id="personal-mail" name="personal-mail" >
                                     <span id="personal-mail-info" class="text-danger float-right"></span>
                                     
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-sm-12">
                                        <label for="work-mail" class="pl-3 col-form-label labelAlign ">Work Mail
                                        </label>
                                     <input type="email" class="form-control" id="work-mail" name="work-mail" >
                                     <span id="work-mail-info" class="text-danger float-right"></span>
                                     
                                    </div>
                                  </div>
                                  <div class="form-group row">
                                    <div class="col-lg-6 col-md-12 col-sm-12">
                                        <label for="home-phone" class="pl-3 col-form-label labelAlign ">Home Phone Number
                                        </label>
                                     <input type="number" class="form-control" id="home-phone" name="home-phone" >
                                     <span id="home-phone-info" class="text-danger float-right"></span>
                                     
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-sm-12">
                                        <label for="mobile-phone" class="pl-3 col-form-label labelAlign ">Mobile Phone Number
                                        </label>
                                     <input type="number" class="form-control" id="mobile-phone" name="mobile-phone" >
                                     <span id="mobile-phone-info" class="text-danger float-right"></span>
                                     
                                    </div>
                                  </div>
                                  <p>Name Change</p>
                                  <div class="form-group row">
                                    <div class="col-lg-6 col-md-12 col-sm-12">
                                        <label for="changedfirstname" class="pl-3 col-form-label labelAlign ">First Name
                                        </label>
                                     <input type="text" class="form-control" id="changedfirstname" name="changedfirstname">
                                     <span id="changedfirstname-info" class="text-danger float-right"></span>
                                     
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-sm-12">
                                        <label for="changedlastname" class="pl-3 col-form-label labelAlign ">Last Name
                                        </label>
                                     <input type="text" class="form-control" id="changedlastname" name="changedlastname" >
                                     <span id="changedlastname-info" class="text-danger float-right"></span>
                                     
                                    </div>
                                  </div>
                                 
                                  <div class="col-12 pt-4">
                                    <div class="sec-title-wrap d-block">
                                        <h2 class="sec-title c-prime font-segoe-sb">
                                            Change Employer Information
                                        </h2>
                                    </div>  </div>
                                    <div class="form-group row">
                                        <div class="col-lg-6 col-md-12 col-sm-12">
                                            <label for="new-emp" class="pl-3 col-form-label labelAlign ">New Employer
                                            </label>
                                         <input type="text" class="form-control" id="new-emp" name="new-emp">
                                         <span id="new-emp-info" class="text-danger float-right"></span>
                                         
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-sm-12">
                                            <label for="wfi" class="pl-3 col-form-label labelAlign ">WFI ID#
                                            </label>
                                         <input type="number" class="form-control" id="wfi" name="wfi" >
                                         <span id="wfi-info" class="text-danger float-right"></span>
                                         
                                        </div>
                                      </div>
                                      <div class="form-group row">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <label for="emp-mail-address" class="pl-3 col-form-label labelAlign ">Employer Mailing Address
                                            </label>
                                         <input type="email" class="form-control" id="emp-mail-address" name="emp-mail-address">
                                         <span id="emp-mail-address-info" class="text-danger float-right"></span>
                                         
                                        </div>
                                      
                                      </div>

                                      <div class="form-group row">
                                        <div class="col-lg-4 col-md-12 col-sm-12">
                                            <label for="empcity" class="pl-3 col-form-label labelAlign ">City
                                            </label>
                                         <input type="text" class="form-control" id="empcity" name="empcity">
                                         <span id="empcity-info" class="text-danger float-right"></span>
                                         
                                        </div>
                                        <div class="col-lg-4 col-md-12 col-sm-12">
                                            <label for="empstate" class="pl-3 col-form-label labelAlign ">State
                                            </label>
                                         <input type="text" class="form-control" id="empstate" name="empstate">
                                         <span id="empstate-info" class="text-danger float-right"></span>
                                         
                                        </div>
                                        <div class="col-lg-4 col-md-12 col-sm-12">
                                            <label for="empzipcode" class="pl-3 col-form-label labelAlign ">Zip Code
                                            </label>
                                         <input type="number" class="form-control" id="empzipcode" name="empzipcode">
                                         <span id="empzipcode-info" class="text-danger float-right"></span>
                                         
                                        </div>
                                      
                                      </div>
                                      <div class="form group row">
                                        <div class="col-lg-6 col-md-12 col-sm-12">
                                            <label for="emp-phone" class="pl-3 col-form-label labelAlign ">Employer Phone Number
                                            </label>
                                         <input type="number" class="form-control" id="emp-phone" name="emp-phone">
                                         <span id="emp-phone-info" class="text-danger float-right"></span>
                                         
                                        </div>
                                      </div>

                            <div class="w-100 mt-4">
                                <button type="submit" class="btn btn-sec btn-bordered-sm btn-sm mt-3">Submit</button>
                            </div>
   
       </form>
</div>
                                  
                                  
<?php
do_action('ecommerce_gem_action_sidebar');

get_footer();
?><div class="col-12 col-md-4 col-lg-3">
                    <?php if (have_rows('sidebar_components', 'option')):
                while (have_rows('sidebar_components', 'option')): the_row();
                    if (get_row_layout() == 'add_menu_to_sidebar'):
                      $menuSidebar = get_sub_field('add_menu', 'option');
                        $menuVar = array(
                          'menu'                 => $menuSidebar,
                          'container'            => false,
                          // 'container'            => 'div',
                          // 'container_class'      => 'conc',
                          // 'container_id'         => 'conc',
                          'menu_class'           => 'secMenu nav nav-pills nav-fill flex-column',
                          'menu_id'              => $menuSidebar,
                          'echo'                 => true,
                          'items_wrap'           => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                          'item_spacing'         => 'preserve',
                          'depth'                => 0,
                          // 'add_li_class'  => 'your-class-name1 your-class-name-2',
                          'add_link_class'  => 'nav-link d-flex align-items-center flex-row-reverse justify-content-end',
                          'theme_location'       =>  $menuSidebar,
                          'fallback_cb' => 'bs4navwalker::fallback',
                          'walker' => new bs4navwalker(),
                            );
                        wp_nav_menu( $menuVar );

                        elseif (get_row_layout() == 'search_hire_bat'):
                          $menuSidebar = get_sub_field('is_search_to_hire_a_bat', 'option');?>
                    <?php if($menuSidebar == 'yes'): ?>
                    <div class="search-box pt-5">
                        <div class="sec-title-wrap">
                            <h2 class="sec-title c-prime font-segoe-sb">
                                Search to Hire a BAT
                            </h2>
                        </div>
                        <form class="form-mod">
                            <div class="form-group">
                                <label for="county">By BATs County</label>
                                <select id="county" class="form-control">
                                    <option>Select County</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="searchName">By BAT List by Name</label>
                                <input type="text" class="form-control" id="searchName" placeholder="Search by name">
                            </div>
                            <button type="submit" class="btn btn-prime btn-fw no-border-radius">Search BATs</button>
                        </form>
                    </div>
                    <?php endif; ?>
                    <?php elseif (get_row_layout() == 'single_info_box'):
                          $svgIconTitle = get_sub_field('title', 'option');
                          
                          ?>

                    <div class="single-info-box d-flex align-items-center pt-4">
                        <?php 
                            if( have_rows('svg_icons','option') ): ?>
                        <?php while( have_rows('svg_icons','option') ): the_row(); 
                              $svgIcon = get_sub_field('upload_svg_icon', 'option');
                             
                              $svgIconClass = get_sub_field('svg_icon_class', 'option');
                              $svgIconViewBox = get_sub_field('viewbox_value', 'option');
                              $svgIconHash = get_sub_field('svg_icon_hashvalue', 'option');
                              // append icon
                              //if( $svgIcon ):?>
                        <svg class="<?php echo $svgIconClass; ?>" viewBox="<?php echo $svgIconViewBox; ?>">
                            <use xlink:href="<?php echo esc_url( $svgIcon['url'] ); ?>#<?php echo $svgIconHash; ?>">
                            </use>
                        </svg>
                        <?php //endif;
                              ?>
                        <?php endwhile; ?>
                        <?php endif; ?>
                        <span><?php echo $svgIconTitle; ?></span>
                    </div>

                    <?php elseif (get_row_layout() == 'single_image'):
                             $singleImage = get_sub_field('single_image', 'option');
                             $singleImageWrapClass = get_sub_field('single_image_wrap_class', 'option');

                             $addLinkToImage = get_sub_field('add_link_to_image', 'option');

                             if($singleImage):
                              ?>
                    <div
                        class="<?php if($singleImageWrapClass && $singleImage): echo $singleImageWrapClass; else: echo 'batalk-logo-wrap bg-70 mt-5'; endif;?>">
                        <?php  
    $addLinkToImage_url = $addLinkToImage['url'];
    $addLinkToImage_title = $addLinkToImage['title'];
    $addLinkToImage_target = $addLinkToImage['target'] ? $addLinkToImage['target'] : '_self';

    if( $addLinkToImage ):
    ?>
                        <a href="<?php echo esc_url( $addLinkToImage_url ); ?>"
                            target="<?php echo esc_attr( $addLinkToImage_target ); ?>">
                            <?php endif; ?>
                            <img class="img-fluid" src="<?php echo esc_url( $singleImage['url'] ); ?>"
                                alt="<?php echo esc_attr( $singleImage['alt'] ); ?>">
                            <?php if( $addLinkToImage ):
    ?></a><?php endif; ?>
                    </div>
                    <?php
                             endif;
                            ?>
                    <?php elseif (get_row_layout() == 'add_working_hours'):
                          $workingHourTimings = get_sub_field('working_hours_timings', 'option');?>
                    <div class="working-hours-box bg-prime text-white py-4 px-5 mt-5">
                        <?php 
                            if( have_rows('add_title','option') ): ?>
                        <div class="wh-title d-flex align-items-center pt-4">
                            <?php while( have_rows('add_title','option') ): the_row();
                               $addIcon = get_sub_field('add_icon', 'option');
                               $whTitle = get_sub_field('title', 'option');
                              ?>
                            <img class="img-fluid pr-3" src="<?php echo esc_url( $addIcon['url']); ?>"
                                alt="<?php echo esc_attr( $addIcon['alt']); ?>">
                            <h3 class="font16 pt-2 text-white"><?php echo $whTitle; ?></h3>
                            <?php endwhile; ?>
                        </div>
                        <?php endif; ?>
                        <?php if($workingHourTimings): echo $workingHourTimings; else: echo '<div class="timing font16 pt-3">Weekdays : 6:30 – 18:00</div><div class="timing font16 pt-3 pb-4">Weekend : 8.00 - 12:00</div>'; endif; ?>
                    </div>
                    <?php
                 
                        
                    endif;
                endwhile;
            endif;
            ?>

                </div>

            </div>
        </div>
    </div><!-- /. Main Content -->
</div>
<?php
do_action('ecommerce_gem_action_sidebar');

get_footer();
?>