<?php require_once(__DIR__.'/layouts/header.php');?>

<h2>Information about myself</h2>

<?php if (empty($_SESSION['user'])): ?>
<p>You haven't add information yet</p>
<?php else: ?>
	<div class="table">
		<table>
		    <?php foreach ($_SESSION['user'] as $key => $value): ?>
		    <tr>
		        <td class="key"><?php echo ucfirst($key); ?></td>
		        <td class="value"><?php echo $value; ?></td>
		    </tr>
		    <?php endforeach; ?>
		</table>
	</div>
	<div class="image">
		<img src="<?php echo $_SESSION['userfiles']['img']; ?>" />
	</div>
	<h3>My story</h3>
	<p><?php echo $_SESSION['aboutmyself'];?></p>
<?php endif; ?>

<?php require_once(__DIR__.'/layouts/footer.php');?>
