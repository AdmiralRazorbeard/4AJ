<nav id="subMenu">
	<ul>
		<li><a <?php if (openSubSection('accueillir')){?>id="active_submenu_item"<?php } else { ?>id="submenu_item"<?php } ?> href="index.php?section=plateformeLogement&amp;subSection=accueillir"><?php langue('Accueillir', 'Welcome'); ?></a></li>
		<li><a <?php if (openSubSection('informer')){?>id="active_submenu_item"<?php } else { ?>id="submenu_item"<?php } ?> href="index.php?section=plateformeLogement&amp;subSection=informer"><?php langue('Informer', 'Inform'); ?></a></li>
		<li><a <?php if (openSubSection('atelier')){?>id="active_submenu_item"<?php } else { ?>id="submenu_item"<?php } ?> href="index.php?section=plateformeLogement&amp;subSection=atelier"><?php langue('Atelier', 'Workshop'); ?></a></li>
		<li><a <?php if (openSubSection('accompagner')){?>id="active_submenu_item"<?php } else { ?>id="submenu_item"<?php } ?> href="index.php?section=plateformeLogement&amp;subSection=accompagner"><?php langue('Accompagner', 'Accompany'); ?></a></li>
		<li><a <?php if (openSubSection('documenter')){?>id="active_submenu_item"<?php } else { ?>id="submenu_item"<?php } ?> href="index.php?section=plateformeLogement&amp;subSection=documenter"><?php langue('Documenter', 'Documenting'); ?></a></li>
		<li><a <?php if (openSubSection('contact')){?>id="active_submenu_item"<?php } else { ?>id="submenu_item"<?php } ?> href="index.php?section=plateformeLogement&amp;subSection=contact">Contact</a></li>	
	</ul>
</nav>