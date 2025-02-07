/**
 * Main animation initialization
 * Waits for DOM to be fully loaded before running animations
 */
document.addEventListener('DOMContentLoaded', function() {
    /**
     * Hero Section Animations
     * Animates the hero section elements with a staggered entrance
     */
    
    // Animate the main title
    gsap.from('.banner__title', {
        duration: 1,        // Animation takes 1 second
        y: 30,             // Starts 30px below final position
        opacity: 0,        // Fades in from transparent
        ease: 'power3.out' // Smooth easing, fast at start, slow at end
    });

    // Animate the subtitle text with a slight delay
    gsap.from('.banner__text', {
        duration: 1,
        y: 30,
        opacity: 0,
        delay: 0.3,        // Waits 0.3 seconds after title animation starts
        ease: 'power3.out'
    });

    // Animate the banner image with a scale effect
    gsap.from('#banner-image', {
        duration: 1.2,
        scale: 0.8,        // Starts at 80% of final size
        opacity: 0,
        delay: 0.2,
        ease: 'power3.out'
    });

    /**
     * Services Section Animations
     * Triggered when services section comes into view
     */
    gsap.from('.services-col', {
        duration: 0.8,
        y: 50,
        opacity: 0,
        stagger: 0.2,      // Each column animates 0.2 seconds after the previous
        ease: 'power2.out',
        scrollTrigger: {
            trigger: '.services-col',
            start: 'top 80%',    // Starts animation when element is 80% from top of viewport
            toggleActions: 'play none none reverse' // Play on enter, reverse on leave
        }
    });

    /**
     * Recent Works Animations
     * Staggered animations for portfolio items with different elements
     */
    const workItems = gsap.utils.toArray('.ftf-post-item');
    workItems.forEach((item, index) => {
        // Create a timeline for each work item
        const tl = gsap.timeline({
            scrollTrigger: {
                trigger: item,
                start: 'top 80%',
                toggleActions: 'play none none reverse'
            }
        });

        // Get elements within the work item
        const thumbnail = item.querySelector('.ftf-post-item__thumbnail');
        const title = item.querySelector('.ftf-post-item__title');
        const excerpt = item.querySelector('.ftf-post-item__excerpt');
        const terms = item.querySelector('.ftf-post-item__terms');
        const button = item.querySelector('.ftf-post-item__button');

        // Alternate animation direction based on item index
        const direction = index % 2 === 0 ? -1 : 1;

        // Build the animation sequence
        tl.from(thumbnail, {
            duration: 0.8,
            x: 50 * direction,
            opacity: 0,
            ease: 'power2.out'
        })
        .from(title, {
            duration: 0.6,
            y: 20,
            opacity: 0,
            ease: 'power2.out'
        }, '-=0.4')
        .from(excerpt, {
            duration: 0.6,
            y: 20,
            opacity: 0,
            ease: 'power2.out'
        }, '-=0.4')
        .from(terms, {
            duration: 0.6,
            y: 20,
            opacity: 0,
            ease: 'power2.out'
        }, '-=0.4')
        .from(button, {
            duration: 0.6,
            y: 20,
            opacity: 0,
            ease: 'power2.out'
        }, '-=0.4');
    });

    /**
     * Testimonials Section Animations
     * Fade in section on scroll and animate messages on carousel change
     */
    
    // Fade in the entire testimonials section
    gsap.from('.ftf-module-testimonials-carousel', {
        duration: 1,
        opacity: 0,
        ease: 'power2.out',
        scrollTrigger: {
            trigger: '.ftf-module-testimonials-carousel',
            start: 'top 80%',
            toggleActions: 'play none none none'
        }
    });

    // Function to animate testimonial content
    function animateTestimonialContent(message) {
        gsap.fromTo(message,
            { 
                opacity: 0,
                y: 30,
                scale: 0.95
            },
            {
                duration: 0.8,
                opacity: 1,
                y: 0,
                scale: 1,
                ease: 'back.out(1.2)',
                clearProps: 'scale' // Clean up scale after animation
            }
        );
    }

    // Initialize testimonial animations using jQuery to match parent theme
    jQuery(document).ready(function($) {
        const $swiperContainer = $('.ftf-module-testimonials-carousel .swiper-container');
        
        if ($swiperContainer.length) {
            // Wait a short moment for Swiper to be fully initialized
            setTimeout(() => {
                const swiper = $swiperContainer[0].swiper;
                if (swiper) {
                    // Animate initial slide
                    const $initialMessage = $(swiper.slides[swiper.activeIndex]).find('.testimonial__message');
                    if ($initialMessage.length) {
                        animateTestimonialContent($initialMessage[0]);
                    }

                    // Add event listener for slide changes
                    swiper.on('slideChangeTransitionStart', function() {
                        const $activeMessage = $(swiper.slides[swiper.activeIndex]).find('.testimonial__message');
                        if ($activeMessage.length) {
                            animateTestimonialContent($activeMessage[0]);
                        }
                    });
                }
            }, 500); // Increased timeout to ensure Swiper is ready
        }
    });

    /**
     * Call-to-Action Animation
     * Subtle entrance animation for the CTA section
     */
    gsap.from('.ftf-cta', {
        duration: 1,
        y: 30,
        opacity: 0,
        ease: 'power2.out',
        scrollTrigger: {
            trigger: '.ftf-cta',
            start: 'top 80%',
            toggleActions: 'play none none reverse'
        }
    });

    /**
     * Button Hover Animations
     * Interactive animations for all buttons
     * Scales up on hover and back to normal on mouse leave
     */
    const buttons = document.querySelectorAll('.button');
    buttons.forEach(button => {
        // Mouse enter animation
        button.addEventListener('mouseenter', () => {
            gsap.to(button, {
                scale: 1.05,     // Increase size by 5%
                duration: 0.3,    // Quick animation
                ease: 'power2.out'
            });
        });
        
        // Mouse leave animation
        button.addEventListener('mouseleave', () => {
            gsap.to(button, {
                scale: 1,        // Return to original size
                duration: 0.3,
                ease: 'power2.in'
            });
        });
    });
}); 