<?php
function toolBox ($id, $cols = 50, $rows = 15)
// On Renseigne juste l'id du text area (et si besoin cols & rows)
{ ?>
	<script type="text/javascript">
	function insertTag(startTag, endTag, textareaId, tagType) {
		var field  = document.getElementById(textareaId); 
		var scroll = field.scrollTop;
		field.focus();
		
		/* === Partie 1 : on récupère la sélection === */
		if (window.ActiveXObject) {
				var textRange = document.selection.createRange();            
				var currentSelection = textRange.text;
		} else {
				var startSelection   = field.value.substring(0, field.selectionStart);
				var currentSelection = field.value.substring(field.selectionStart, field.selectionEnd);
				var endSelection     = field.value.substring(field.selectionEnd);               
		}
		
		/* === Partie 2 : on analyse le tagType === */
		if (tagType == 'lien') {
			// Si c'est un lien 
			endTag = "</lien>";
			if (currentSelection) { // Il y a une sélection
					if (currentSelection.indexOf("http://") == 0 || currentSelection.indexOf("https://") == 0 || currentSelection.indexOf("ftp://") == 0 || currentSelection.indexOf("www.") == 0) {
							// La sélection semble être un lien. On demande alors le libellé
							var label = prompt("Quel est le libellé du lien ?") || "";
							startTag = "<lien url=\"" + currentSelection + "\">";
							currentSelection = label;
					} else {
							// La sélection n'est pas un lien, donc c'est le libelle. On demande alors l'URL
							var URL = prompt("Quelle est l'url ?");
							startTag = "<lien url=\"" + URL + "\">";
					}
			} else { // Pas de sélection, donc on demande l'URL et le libelle
					var URL = prompt("Quelle est l'url ?") || "";
					var label = prompt("Quel est le libellé du lien ?") || "";
					startTag = "<lien url=\"" + URL + "\">";
					currentSelection = label;                     
			}			
		}
		
		/* === Partie 3 : on insère le tout === */
		if (window.ActiveXObject) {
				textRange.text = startTag + currentSelection + endTag;
				textRange.moveStart("character", -endTag.length - currentSelection.length);
				textRange.moveEnd("character", -endTag.length);
				textRange.select();     
		} else {
				field.value = startSelection + startTag + currentSelection + endTag + endSelection;
				field.focus();
				field.setSelectionRange(startSelection.length + startTag.length, startSelection.length + startTag.length + currentSelection.length);
		} 

		field.scrollTop = scroll;     
	}
function preview(textareaId, previewDiv) {
	var field = textareaId.value;
	if (document.getElementById('previsualisation').checked && field) {
		
	
		field = field.replace(/&/g, '&amp;');
		field = field.replace(/</g, '&lt;').replace(/>/g, '&gt;');
		field = field.replace(/\n/g, '<br />').replace(/\t/g, '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');
		field = field.replace(/&lt;gras&gt;([\s\S]*?)&lt;\/gras&gt;/g, '<strong>$1</strong>');
		field = field.replace(/&lt;italique&gt;([\s\S]*?)&lt;\/italique&gt;/g, '<em>$1</em>');
		field = field.replace(/&lt;lien&gt;([\s\S]*?)&lt;\/lien&gt;/g, '<a href="$1">$1</a>');
		field = field.replace(/&lt;lien url="([\s\S]*?)"&gt;([\s\S]*?)&lt;\/lien&gt;/g, '<a href="$1" title="$2">$2</a>');
		field = field.replace(/&lt;taille valeur=\"(.*?)\"&gt;([\s\S]*?)&lt;\/taille&gt;/g, '<span class="$1">$2</span>');

		
		document.getElementById(previewDiv).innerHTML = field;
	}
}
	</script>
	<!-- Mise en forme du text area -->
<div>   
	<p>
		<input type="button" value="G" onclick="insertTag('<gras>','</gras>','contenu');"/>
		<input type="button" value="I" onclick="insertTag('<italique>','</italique>','contenu');"/>
		<input type="button" value="Lien" onclick="insertTag('','','contenu','lien');"/>
		<select onchange="insertTag('<taille valeur=&quot;' + this.options[this.selectedIndex].value + '&quot;>', '</taille>', 'contenu');">
			<option value="none" class="selected" selected="selected">Taille</option>
			<option value="ttpetit">Très très petit</option>
			<option value="tpetit">Très petit</option>
			<option value="petit">Petit</option>
			<option value="gros">Gros</option>
			<option value="tgros">Très gros</option>
			<option value="ttgros">Très très gros</option>
		</select>
	</p>
	<p>
		<input name="previsualisation" type="checkbox" id="previsualisation" value="previsualisation" />
		<label for="previsualisation">Prévisualisation automatique</label>
	</p>
</div>
<textarea name="<?php echo $id; ?>" id="<?php echo $id; ?>" onkeyup="preview(this, 'viewDiv');" onselect="preview(this, 'viewDiv');" cols="<?php echo $cols; ?>" rows="<?php echo $rows; ?>"></textarea><br />
<div id="viewDiv">
	<!-- Affichage de la prévisualisation -->
</div><br />
<?php
}
function regexTextBox($contenu)
{
	$contenu = nl2br(htmlspecialchars($contenu));
	$contenu = preg_replace('#&lt;gras&gt;(.+)&lt;/gras&gt;#', '<b>$1</b>', $contenu);
	$contenu = preg_replace('#&lt;italique&gt;(.+)&lt;/italique&gt;#', '<em>$1</em>', $contenu);
	$contenu = preg_replace('#&lt;taille valeur=&quot;(.+)&quot;&gt;(.+)&lt;/taille&gt;#', '<span class="$1">$2</span>', $contenu);
	$contenu = preg_replace('#&lt;lien url=&quot;(.+)&quot;&gt;(.+)&lt;/lien&gt;#', '<a href="$1">$2</a>', $contenu);	
	return $contenu;
}
?>