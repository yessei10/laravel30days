<x-layout>
    <x-slot:headings>
        Jobs Page
    </x-slot:headings>

    <h2 class="font-bold text-lg">{{$job->title}}</h2>

    <p>
        This jobs pays {{$job->salary}} per year.
    </p>

    <p class="mt-6">
        <x-button href="/jobs/{{$job->id}}/edit">Edit Job</x-button>
    </p>
</x-layout>