<style>

footer{
	/*grid-row: footer_start/ footer_end;*/
	grid-column: 1 / -1;
	background-color: black;
	color: #fdfdfa;
	display: flex;
	flex-direction: column;
	/*justify-content: center;*/
	/*align-content: center;
	align-items: center;*/
	font-size: 1.2rem;
	padding: 1rem;

}

.footer_title{
	display: flex;
	flex-direction: column;
	/*justify-content: center;*/
	align-items: center;
	align-content: center;
	color: lightgrey;
}
.footer_title p:first-child{
	letter-spacing: 4px;
	font-size: 2.5rem;
	text-transform: uppercase;
}

.footer_title p:hover{
	font-size: 2.6rem;
	color: grey;
}

.footer_services{
	margin: 1.5rem 0;
	display: flex;
	justify-content: space-around;
	color: lightgrey;
}

.footer_services h1{
   font-size: 1.4rem;
}

.footer_services h1:hover {
   color: grey;
   font-size: 1.5rem;
}

.footer_services p {
	font-size: 1rem;
}

.footer_links{
	display: flex;
	flex-direction: column;
}

.footer_links li {
	list-style: none;
	padding: 0 .5rem;
}

.footer_links li a {
	color : lightgrey;
}

.footer_links li a:hover{
	text-decoration: underline;
	font-size: 1.2rem;
	color: grey;
}

.copyright {
	display: flex;
	color: lightgrey;
	justify-content: center;
	margin-top:  1.2rem;
}




</style>

<footer>
	<div class="footer_title">
		<p>Unique Shop</p>
	</div>
<div class="footer_services">
	<div class="paymentmethod">
		<h1>Payment Method</h1>
		<p>Secure Online Payment Using Stripe </p>
	</div>
	<ul class="footer_links">
		<li><a href="">Home</a></li>
    	<li><a href="">About</a></li>
		<li><a href="">Contact</a></li>
    </ul>
	<div class="footer_returns">
		<h1>Returns</h1>
		<p>7 day Moneyback Quarantee</p>
	</div>
    

</div>
<div class="copyright">
	<p>Copyright &copy; <?php echo date('Y'); ?> By Anish Ghimire </p>
</div>
	 	
</footer>




