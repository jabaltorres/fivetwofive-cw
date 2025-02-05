// Wait for DOM to be ready
document.addEventListener('DOMContentLoaded', function() {
    // Fade in hero section
    gsap.from('.hero', {
        duration: 1,
        opacity: 0,
        y: 100,
        ease: 'power3.out'
    });

    // Stagger animate multiple elements
    gsap.from('.ftf-module__description', {
        duration: 0.8,
        opacity: 0,
        y: 30,
        stagger: 0.2,
        ease: 'power2.out',
        scrollTrigger: {
            trigger: '.ftf-module__description',
            start: 'top 80%',
            toggleActions: 'play none none reverse'
        }
    });

    // Animate on hover
    const buttons = document.querySelectorAll('.button');
    buttons.forEach(button => {
        button.addEventListener('mouseenter', () => {
            gsap.to(button, {
                scale: 1.05,
                duration: 0.3,
                ease: 'power2.out'
            });
        });
        
        button.addEventListener('mouseleave', () => {
            gsap.to(button, {
                scale: 1,
                duration: 0.3,
                ease: 'power2.in'
            });
        });
    });

    // Split text animation (requires GSAP SplitText plugin)
    // Note: SplitText is a premium plugin
    /*
    const splitText = new SplitText('.hero-title', {type: 'chars'});
    gsap.from(splitText.chars, {
        duration: 0.6,
        opacity: 0,
        y: 20,
        stagger: 0.02,
        ease: 'power2.out'
    });
    */
}); 