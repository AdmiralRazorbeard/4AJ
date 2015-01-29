<nav id="subMenu">
	<ul>
		<li><a <?php if (openSubSection('accueillir')){?>class="active_submenu_item"<?php } else { ?>class="submenu_item"<?php } ?> href="index.php?section=plateformeLogement&amp;subSection=accueillir"><?php langue('Accueillir', 'Welcome'); ?></a></li>
		<li><a <?php if (openSubSection('informer')){?>class="active_submenu_item"<?php } else { ?>class="submenu_item"<?php } ?> href="index.php?section=plateformeLogement&amp;subSection=informer"><?php langue('Informer', 'Inform'); ?></a></li>
		<li><a <?php if (openSubSection('atelier')){?>class="active_submenu_item"<?php } else { ?>class="submenu_item"<?php } ?> href="index.php?section=plateformeLogement&amp;subSection=atelier"><?php langue('Ateliers', 'Workshops'); ?></a></li>
		<li><a <?php if (openSubSection('accompagner')){?>class="active_submenu_item"<?php } else { ?>class="submenu_item"<?php } ?> href="index.php?section=plateformeLogement&amp;subSection=accompagner"><?php langue('Accompagner', 'Accompany'); ?></a></li>
		<li><a <?php if (openSubSection('documenter')){?>class="active_submenu_item"<?php } else { ?>class="submenu_item"<?php } ?> href="index.php?section=plateformeLogement&amp;subSection=documenter"><?php langue('Documenter', 'Documenting'); ?></a></li>
		<li><a <?php if (openSubSection('contact')){?>class="active_submenu_item correct_size_contactPlateforme"<?php } else { ?>class="submenu_item correct_size_contactPlateforme"<?php } ?> href="index.php?section=plateformeLogement&amp;subSection=contact"><?php langue('Contact Plateforme', 'Contact Plateform'); ?></a></li>	
	</ul>
</nav>