<!-- <?php
foreach ($categories as $category) {
        echo "<p> $category->name, $category->description </p>";
}
?> -->
<h1>Laravel</h1>
@foreach ($categories as $category)
    <p> {{ $category->name }} </p>
@endforeach