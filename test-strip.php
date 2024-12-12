<form id="payment-form" action="process-payment.php" method="POST">
    <div class="container">
        <h3>Billing Address</h3>
        <input type="email" id="email" name="email" placeholder="Email Address" required>
        <input type="text" id="price" name="price" placeholder="Amount (USD)" required>

        <h3>Payment Details</h3>
        <div id="card-element"></div>
        <div id="card-errors" role="alert"></div>

        <!-- Hidden field for Stripe Token -->
        <input type="hidden" name="stripeToken" id="stripeToken">

        <button type="submit" class="theme-btn">Place Order</button>
    </div>
</form>

<script src="https://js.stripe.com/v3/"></script>
<script>
    const stripe = Stripe('pk_test_63t8nT9v0tVZoAnVDON58Btf'); // Replace with your Stripe Publishable Key
    const elements = stripe.elements();
    const cardElement = elements.create('card');
    cardElement.mount('#card-element');

    const form = document.getElementById('payment-form');
    form.addEventListener('submit', async (event) => {
        event.preventDefault();

        const { error, token } = await stripe.createToken(cardElement);

        if (error) {
            document.getElementById('card-errors').textContent = error.message;
        } else {
            document.getElementById('stripeToken').value = token.id;
            form.submit(); // Submit the form to the server
        }
    });
</script>
