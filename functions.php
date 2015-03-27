<?php
function getBitcoinRate() {
	$btc_rate_file = "btc_eur.txt";
	// Do we need to update the BTC rate?
	@ $time = filemtime($btc_rate_file);
	if( ! $time || $time < time()-10*60  ) {
		// File is too old, grab it
		$BITAVERAGE = "https://api.bitcoinaverage.com/ticker/EUR/";

		// Get the data from bitcoin average
		$btc_average = json_decode( file_get_contents($BITAVERAGE), true );

		if( ! $btc_average || ! is_array($btc_average) ) {
				die();
		}

		// Get EUR price
		$eur = $btc_average['last'];

		// Save file
		if( $eur > 0 ) {
			file_put_contents($btc_rate_file, $eur);
		}
	} else {
		$eur = file_get_contents($btc_rate_file);
	}
	
	return $eur;
}

function Calc($bitcoins, $option, $REFERRAL_CODE, $indirizzo, $email){
	$PPO = ('PP'==$option);
	$CreditOrder = ('SC'==$option);
	$CC = ($CreditOrder?1:0);
	$PP = ($PPO?1:0);
	
	$result = file_get_contents( "http://www.flashbitcoin.org/Value.php?$bitcoins?$CC?$PP" );
	$json = json_decode( $result, true );
	if( json_last_error ()==JSON_ERROR_NONE && is_array($json) ) {
		// We can continue
		if( $json['State']=='Error' ) {
			return "Qualcosa è andato storto, riprova!";
		} else if( $json['State']=='Maintenance' ) {
			return "Blockchain non è al momento raggiungibile. Riprova a breve";
		} else if( $json['State']=='Locked' ) {
			return "Disponibilità con SuperFlash esaurita, un messaggio è stato inviato agli admim e a breve saranno nuovamente disponibili.";
		} else if( $json['State']=='OK' ) {
			$ticket = $json['Verifier'];
			return Data( $bitcoins, $json['Value'], $PPO, $CreditOrder, $ticket, $REFERRAL_CODE, $indirizzo, $email );
		} else {
			return "Internal Error";
		}
	} else {
		return "Qualcosa è andato storto, riprova!";
	}
}

function Data( $bitcoins, $value, $PPO, $CreditOrder, $TICKET, $REFERRAL_CODE, $indirizzo, $email ){
	$Delim=";";
	$Satoshi=0+$bitcoins;
	$Satoshi=100000000*$Satoshi;
	$Ref=$REFERRAL_CODE ? $REFERRAL_CODE : "0";
	$ORDERTYPE = PPO?"P":(CreditOrder?"C":"B");
	$value = str_replace( ",", ".", $value );
	$Data=$value.$Delim.$Satoshi.$Delim.$indirizzo.$Delim.$email.$Delim.$Ref.'?'.$ORDERTYPE.$TICKET;
	
	$result = file_get_contents( "http://www.flashbitcoin.org/Str.php?".$Data );
	
	return "DONE";
}
?>