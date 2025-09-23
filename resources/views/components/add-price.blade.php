
<h1 class="max-w-2xl mb-4 text-4xl font-extrabold leading-none tracking-tight md:text-5xl xl:text-6xl dark:text-white">
    Contact Us
</h1>
<div class="max-w-2xl mb-4  leading-none tracking-tight dark:text-white">
<form method="POST" action="{{ route('price.submit') }}">
    @csrf {{-- Cross-Site Request Forgery protection --}}
    <label for="name">Name:</label><br>
    <input type="text" id="name" name="name" required><br>

    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" required><br>

    <label for="message">Message:</label><br>
    <textarea id="message" name="message" required></textarea><br>

    <input type="submit" value="Submit">
</form>
</div>
