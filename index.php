<?php
	// Set your referral code here.
	$REFERRAL_CODE = "";

	include_once 'functions.php';
	$rate = number_format(getBitcoinRate() * 1.06, 2, ",", ".");
	$message = "";
	
	if( isset( $_POST['procedi'] ) ) {
		if( $_POST['numero_bitcoin'] && $_POST['indirizzo'] && $_POST['Email'] ) {
			$message = Calc( $_POST['numero_bitcoin'], $_POST['option'], $REFERRAL_CODE, $_POST['indirizzo'], $_POST['Email'] );
		} else {
			$message = "Inserire tutte le informazioni necessarie";
		}
	}	
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>Flash Bitcoin | Dove Potrai Comprare Bitcoin in Maniera Facile e Veloce</title>
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <link href="style.css?b" rel="stylesheet" type="text/css" media="all"/>
</head>

<body class="single">
  <div class="wrap">
    <header>
    	<div class="logo">
    		<a href="index.php">
    			<img src="images/logo.png" alt="logo by mobifreaks"/>
    		</a>
    	</div>   
    </header>
    <div class="content">
    	<article>
    		<section class="head">
				<h3>1 bitcoin = <?php echo $rate; ?> EUR</h3>
			</section>
			<?php if($message) { ?>
			<section class="head">
				<h3><?php echo $message=='DONE' ? 'Per favore controlla la tua mail per ulteriori informazioni su come completare il tuo ordine.' : $message; ?></h3>
			</section>	
			<?php } ?>
			<section>
			
			<?php if('DONE'!=$message) { ?>
			<form class="label-top" id="bitcoindata" name="bitcoindata" action="index.php" method="post">
			    <div>
			         <label for="indirizzo">Indirizzo bitcoin <span class="red">*</span></label>
			         <input type="text" name="indirizzo" id="indirizzo" value="<?php echo $_POST['indirizzo']; ?>" tabindex="1" />
			    </div>
			    <div>
			         <label for="Email">Indirizzo Email <span class="red">*</span></label>
			         <input type="text" name="Email" id="Email" value="<?php echo $_POST['Email']; ?>" tabindex="2" />
			    </div>
			    <div>
			         <label for="totale">Numero bitcoin <span class="red">*</span></label>
			         <input type="number" name="numero_bitcoin" id="numero_bitcoin" onchange="Reset()" required="" min="0.00001" max="5.00000" step="0.00001" value="0.010" pattern="[1-9]" tabindex="3" />
			    </div>
			    <div>
					<select id="option" tabindex="4" name="option">
					  <option value="SF">Ricarica SuperFlash</option>
					  <option value="PP">Ricarica PostePay</option>
					  <option value="SC">Ricarica SuperFlash con carta di credito allo sportello</option>
					</select>
				</div>
				<div>
				    <input type="submit" name="procedi" value="Procedi" id="procedi" tabindex="5" />
			    </div>
			</form>
			<?php } ?>
			
			</section>
		</article>
    </div>
    <footer>
    	<p>&copy; Copyright Flash Bitcoin 2015.<br/>Tutti i diritti riservati.</p>
    </footer>
  </div>
</body>
</html>
