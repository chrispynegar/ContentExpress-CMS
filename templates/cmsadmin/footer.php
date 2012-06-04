		</div>
        <footer>
            <ul>
            	<li><a href="#">Footer Link</a></li>
            	<li><a href="#">Footer Link</a></li>
            	<li><a href="#">Footer Link</a></li>
            	<li><a href="#">Footer Link</a></li>
            	<li><a href="#">Footer Link</a></li>
            </ul>
            <p>Powered by Content Express CMS</p>
        </footer>
    </div>
    
    <script src="../templates/cmsadmin/js/jquery-1.7.2.min.js"></script>
    <script src="../templates/cmsadmin/js/jquery-ui-1.8.20.custom.min.js"></script>
    <script src="../templates/cmsadmin/js/common.js"></script>
    <?php if(isset($scripts) && is_array($scripts)): ?>
    <?php foreach($scripts as $script): ?>
    <script src="../templates/cmsadmin/js/<?php echo $script; ?>.js" /></script>
    <?php endforeach; ?>
    <?php endif; ?>
    
</body>
</html>
