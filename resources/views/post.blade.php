<x-layout>
    <article>
        <h1>{{ $postheader->title;}} </h1>
        <div>
            {!! $postheader->body; !!}
        </div>
        <a href="/">Go Back</a>
    </article>
</x-layout>


