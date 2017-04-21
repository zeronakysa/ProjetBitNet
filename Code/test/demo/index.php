<?php
/*
 * This file is part of the Arnapou jqkeychange package.
 *
 * (c) Arnaud Buathier <arnaud@arnapou.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

$NbExemples = 4;

function FC($file) {
    $path = __DIR__ . '/' . $file;
    if (is_file($path)) {
        $realpath = realpath($path);
        $root     = realpath(__DIR__ . '/..');
        if (strpos($realpath, $root) === 0) {
            return file_get_contents($path);
        }
    }
    return '';
}
?><!DOCTYPE html>
<html>
    <head>
        <title>jqKeychange</title>
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="style.css">
        <script src="//code.jquery.com/jquery-1.10.1.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="../src/keyChange.js"></script>
    </head>
    <body>
        <div class="container">
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="#">jqKeychange</a>
                    </div>
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <li class="active"><a href="#">Exemples</a></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                <a href="https://github.com/arnapou/jqkeychange"><i class="github-icon"></i> Github</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div>

                <p>Vous qui lisez ces lignes, vous devez connaître tous les plugins d'autocomplete et autres qui existent de part la toile.</p>

                <p>Ils sont tous plus ou moins sympas, mais en voulant en chercher un qui ne s'occupe que de la mécanique de détection de la frappe, je me suis retrouvé face au néant.</p>

                <p>J'avais simplement besoin d'un plugin qui me déclenche un évènement de frappe de texte pour effectuer un filtrage sur les données d'un select, impossible d'en trouver un.</p>

                <p>Force a été de constater qu'il était plus rentable de le coder que de passer des heures à chercher.</p>


                <h3>Exemple le plus basique</h3>
                <div class="row">
                    <div class="col-lg-6">
                        <p>Javascript :</p>
                        <pre><code class="js"><?= FC('example1/demo.js'); ?></code></pre>
                        <p>Html :</p>
                        <pre><code class="html"><?= FC('example1/demo.html'); ?></code></pre>
                    </div>
                    <div class="col-lg-6">
                        <p>Résultat :</p>	<?= FC('example1/demo.html') ?>
                        <p><em>On déclare simplement une fonction de callback qui vient écrire le texte tapé dans un <code>span</code>. 
                                Une utilisation réelle serait pour filtrer des données ou faire une requête ajax de filtrage etc ...</em></p>
                    </div>
                </div>

                <h3>Exemple avec plus de paramètres</h3>
                <div class="row">
                    <div class="col-lg-6">
                        <p>Javascript :</p>		<pre><code class="js"><?= FC('example2/demo.js'); ?></code></pre>
                        <p>Html :</p>			<pre><code class="html"><?= FC('example2/demo.html'); ?></code></pre>
                    </div>
                    <div class="col-lg-6">
                        <p>Résultat :</p>	<?= FC('example2/demo.html') ?>
                        <p><em>La syntaxe doit vous rappeler le binding d'évènement jQuery, c'est normal, le principe est le même, vous pouvez 
                                passer des options au binding. Dans le cas ou vous voulez utiliser ces options, il doit d'agir du premier appel à 
                                <code>keyChange</code> pour les éléments considérés, sinon, les options seront ignorées.</em></p>
                    </div>
                </div>

                <h3>Exemple "live" bindé sur document</h3>
                <div class="row">
                    <div class="col-lg-6">
                        <p>Javascript :</p>		<pre><code class="js"><?= FC('example3/demo.js'); ?></code></pre>
                        <p>Html :</p>			<pre><code class="html"><?= FC('example3/demo.html'); ?></code></pre>
                    </div>
                    <div class="col-lg-6">
                        <p>Résultat :</p>	<div><?= FC('example3/demo.html') ?></div>
                        <p><em><button class="demo3">Ajout de dom en live</button><br />
                                cette syntaxe JS ext un équivalent de ce qu'on voudrait naturellement écrire <code>$(document).on('keyChange', ...)</code>.<br />
                                Il est obligatoire de passer par cette syntaxe <code>$(document).keyChange(...)</code> car cela positionne correctement les events dépendants.<br />
                            </em></p>
                    </div>
                </div>

                <h3>Exemple plus exotique</h3>
                <div class="row">
                    <div class="col-lg-6">
                        <p>Javascript :</p>		<pre><code class="js"><?= FC('example4/demo.js'); ?></code></pre>
                        <p>Html :</p>			<pre><code class="html"><?= FC('example4/demo.html'); ?></code></pre>
                    </div>
                    <div class="col-lg-6">
                        <p>Résultat :</p>	<?= FC('example4/demo.html') ?>
                        <p><em>Le code JS déclenche le système de binding <code>.keyChange()</code>, puis connecte ensuite deux évènements via le bind jQuery. 
                                <br />La syntaxe <code>.bind('keyChange', function(evt, text) { ... })</code> 
                                <br />est en fait complètement équivalente à <code>.keyChange(function(evt, text) { ... })</code>
                            </em></p>
                    </div>
                </div>

                <h2>Code source du plugin</h2>
                <pre><code class="js"><?= FC('../src/keyChange.js'); ?></code></pre>


            </div>
        </div><!-- end container -->
        
        <?php for ($i = 1; $i <= $NbExemples; $i++): ?>
            <script type="text/javascript" src="example<?= $i ?>/demo.js"></script>
        <?php endfor; ?>

        <script type="text/javascript">
            function fnToString(fn) {
                var s = String(fn)
                        .replace(/(\n)\t{3}/g, '$1')
                        .replace(/^.*?\n/, '')
                        .replace(/\n.*?$/, '')
                        .replace(/\t/g, '    ');
                s = s.replace(/(['"])([^'"]*)(['"])/g, '<span class="string">$1$2$3</span>');
                s = s.replace(/(\/\/[^\n]+)/g, '<span class="comment">$1</span>');
                s = s.replace(/(\/\*.*?\*\/)/g, '<span class="comment">$1</span>');
                s = s.replace(/(new |\n\s*return |(^|\n)var )/g, '<span class="keyword">$1</span>');
                s = s.replace(/(function\s*)(\()/g, '<span class="keyword">$1</span>$2');
                s = s.replace(/(function\s*)([a-z0-9_-]+\s*\()/gi, '<span class="keyword">$1</span>$2');
                s = s.replace(/(\.)([a-z0-9A-Z]+)(\()/g, '$1<span class="method">$2</span>$3');
                return s;
            }
            $(function() {
                $('button.demo3').click(function() {
                    var $demo = $('<p>' + $('p.demo3').eq(0).html() + '</p>');
                    $('p.demo3').parent().append($demo);
                    $demo.find('input').val();
                    $demo.find('span').html('');
                });
                $('pre .js').each(function() {
                    var html = $(this).html();
                    $(this).html(fnToString(html));
                });
            });
</script>
    </body>
</html>
