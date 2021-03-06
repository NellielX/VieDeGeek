<?php 
$page_title = "Vie De Geek - Les plus controversées";
include ($_SERVER['DOCUMENT_ROOT'].'/VieDeGeek/fragments/shared/header.php');
require_once 'fragments/traitements/db.php';
require_once 'fragments/traitements/anecdote.php';
require_once 'fragments/traitements/inscrit.php';
?>

<?php 
    if(!isset($_GET['nbAnecdotes'])){
        $_GET['nbAnecdotes'] = 0;
    }
    $anecdotes = anecdotesValideesControversees($_GET['nbAnecdotes']);
    foreach ($anecdotes as $uneAnecdote) {
        $inscrit = infoUser($uneAnecdote['num_inscrit']);
?>
<div id="anecdotes">
    <div id="text_anecdotes">
        <?php  echo $uneAnecdote['libelle_anecdote'] ?>
        <div id="split"></div>
        <div id="votes">
            <em> Postée par <?php echo $inscrit[0]['nom_inscrit'] ?> le <?php echo $uneAnecdote['date_creation_anecdote'] ?> : 
                <?php if(isset($_SESSION['login'])){ ?>
            <img height="1%"width="1.5%" src="res/img/fleche_haut.png" alt="up" title="Up vote" onclick="upVote(<?php echo $uneAnecdote['num_anecdote']; ?>)"/>
                <img height="1%"width="1.5%" src="res/img/fleche_bas.png" alt="down" title="Down vote" onclick="downVote(<?php echo $uneAnecdote['num_anecdote']; ?>)"/>
                / <?php } ?><label id="<?php echo $uneAnecdote['num_anecdote']; ?>"><?php echo $uneAnecdote['nb_like'] - $uneAnecdote['nb_dislike'] ?></label>
                <label id="e<?php echo $uneAnecdote['num_anecdote']; ?>"></label>
            </em>
        </div>
    </div>
</div>
 <?php
    }
 ?>

<div id="bas_de_page">
    <table align="center">
        <tr>
            <?php
                $precedent = intval($_GET['nbAnecdotes']) - 12;
                $nbAnecdotes = nbAnecdotes();
                $suivant = intval($_GET['nbAnecdotes']) + 12;
                if($precedent >= 0){
            ?>
                    <td><a id="valider" href="controversees.php?nbAnecdotes=<?php echo $precedent ?>">Page précédente</a></td>
            <?php
                }
                if($suivant <= $nbAnecdotes[0][0]){
            ?>
                    <td><a id="valider" href="controversees.php?nbAnecdotes=<?php echo $suivant ?>">Page suivante</a></td>
            <?php
                }
            ?>
        </tr>
    </table>
</div>

<?php
include ($_SERVER['DOCUMENT_ROOT'].'/VieDeGeek/fragments/shared/footer.php');
?>

