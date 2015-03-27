Flash Bitcoin Mobile
====================

Create a stand-alone mobile site to allow people ordering bitcoins via http://www.flashbitcoin.org/

# What is this?
A simple stand-alone mobile site that connects to flashbitcoin.org to order bitcoins. It allows you to use your own referral code and can be easily added to an existing mobile app.

# Instructions to install on your website
	* Edit index.php and set your referral code in the variable $REFERRAL_CODE
	* Create a new folder in your server (for example "flashbitcoin") and upload all the contents there. It *must* be in its own folder
	* Make sure the process running the webserver can write the file btc_eur.txt. On linux run "chmod 777 btc_eur.txt"
	* Done! Point your browser to your-site.com/flashbitcoin

# Optionally add this to your own app
	* If you have an existing mobile app, create a new activity in it
	* Add a single WebView in your activity
	* Make the WebView load your-site.com/flashbitcoin
	
