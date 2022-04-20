<!DOCTYPE html>
<html>
    <?php echo $__env->make('layouts.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<body>
<div id="hellopreloader">
    <div class="preloader">
        <svg width="58" height="58">
            <g fill="none" fill-rule="evenodd" stroke="#FFF" stroke-width="1.5" transform="translate(2 1)">
                <circle cx="42.601" cy="11.462" r="5" fill="#fff">
                    <animate attributeName="fill-opacity" begin="0s" calcMode="linear" dur="1.3s" repeatCount="indefinite" values="1;0;0;0;0;0;0;0"/>
                </circle>
                <circle cx="49.063" cy="27.063" r="5" fill="none">
                    <animate attributeName="fill-opacity" begin="0s" calcMode="linear" dur="1.3s" repeatCount="indefinite" values="0;1;0;0;0;0;0;0"/>
                </circle>
                <circle cx="42.601" cy="42.663" r="5" fill="none">
                    <animate attributeName="fill-opacity" begin="0s" calcMode="linear" dur="1.3s" repeatCount="indefinite" values="0;0;1;0;0;0;0;0"/>
                </circle>
                <circle cx="27" cy="49.125" r="5" fill="none">
                    <animate attributeName="fill-opacity" begin="0s" calcMode="linear" dur="1.3s" repeatCount="indefinite" values="0;0;0;1;0;0;0;0"/>
                </circle>
                <circle cx="11.399" cy="42.663" r="5" fill="none">
                    <animate attributeName="fill-opacity" begin="0s" calcMode="linear" dur="1.3s" repeatCount="indefinite" values="0;0;0;0;1;0;0;0"/>
                </circle>
                <circle cx="4.938" cy="27.063" r="5" fill="none">
                    <animate attributeName="fill-opacity" begin="0s" calcMode="linear" dur="1.3s" repeatCount="indefinite" values="0;0;0;0;0;1;0;0"/>
                </circle>
                <circle cx="11.399" cy="11.462" r="5" fill="none">
                    <animate attributeName="fill-opacity" begin="0s" calcMode="linear" dur="1.3s" repeatCount="indefinite" values="0;0;0;0;0;0;1;0"/>
                </circle>
                <circle cx="27" cy="5" r="5" fill="none">
                    <animate attributeName="fill-opacity" begin="0s" calcMode="linear" dur="1.3s" repeatCount="indefinite" values="0;0;0;0;0;0;0;1"/>
                </circle>
            </g>
        </svg>
        <div class="text">Loading ...</div>
    </div>
</div>
    <?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->yieldContent('content'); ?>  
    <?php echo $__env->make('layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->yieldContent('javascript'); ?>
</body>
</html>
<?php /**PATH /home/i1qxzjn7zpro/public_html/softtechover_phase_3/newlaunch/resources/views/layouts/app.blade.php ENDPATH**/ ?>