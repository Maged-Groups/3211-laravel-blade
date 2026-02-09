@extends('layout.base')

@section('title', 'Components Showcase')

@section('layout')
    <x-dynamic.button type='button' text='Home' />
    <x-dynamic.button type='reset' text='About' />
    <x-dynamic.button type='submit' text='Contact' />
    <x-dynamic.button type='button' />

    <x-dynamic.card>
        <h2 class="text-lg font-semibold">Card Header</h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt temporapx-4 rerum reprehenderit minus doloribus
            ipsa nulla dolorem veritatis odio magnam dignissimos quis hic tempore impedit cupiditate ad, at dolore a.
        </p>
    </x-dynamic.card>


    <x-dynamic.special-card>
        <x-slot name="title">Special Card Title</x-slot>
        <x-slot name="content">This is a special card with a description and footer.</x-slot>
        <x-slot name="footer">
            <button class="px-4 py-2 bg-blue-500 text-white rounded">Save</button>
            <button class="px-4 py-2 bg-red-500 text-white rounded">Close</button>
        </x-slot>
    </x-dynamic.special-card>
@endsection
