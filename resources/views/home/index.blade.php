@extends('layouts.main')

@section('container')
  <x-app-layout>
    <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('To Do List') }}
      </h2>
    </x-slot>


    <marquee behavior="" direction="">
      <h1 class="text-6xl font-semibold text-violet-400">Hello World</h1>
    </marquee>

    <main class="container max-w-screen-md flex flex-col items-center gap-4">
      <h3 class="text-2xl font-semibold">My Todo List</h3>

      <table class="w-full text-sm text-left rtl:text-right text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
          <tr>
            <th scope="col" class="px-6 py-3">Activity</th>
            <th scope="col" class="px-6 py-3">Status</th>
            <th scope="col" class="px-6 py-3">Category</th>
            <th scope="col" class="px-6 py-3 col-span-2">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($todos as $todoItem)
            <tr class="bg-white border-b">
              <td class="px-6 py-4">{{ $todoItem->activity }}</td>
              <td class="text-center">
                @if ($todoItem->status == 'PENDING')
                  <span class="p-1 bg-yellow-500 rounded-md">Pending</span>
                @elseif ($todoItem->status == 'DONE')
                  <span class="p-1 bg-green-500 rounded-md text-white">DONE</span>
                @endif
              </td>
              <td class="px-6 py-4">
                {{ $todoItem->category->name }}
              </td>
              <td class="px-6 py-4">
                <form action="{{ route('todos.update', $todoItem->id) }}" method="POST">
                  @csrf
                  @method('PUT')
                  <button class="px-4 py-2 bg-purple-500 text-white rounded-md">Complete</button>
                </form>
              </td>

              <td class="px-6 py-4">
                <form action="{{ route('todos.destroy', $todoItem->id) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button class="px-4 py-2 bg-red-500 text-white rounded-md">Delete</button>
                </form>
              {{-- </td> --}}
            </tr>
          @endforeach
        </tbody>
      </table>

      <form class="flex gap-2" method="post" action="/todos">
        @csrf
        <input type="text" class="border-2 rounded-md px-2" name="todo-item" autofocus>
        <select class="rounded-md" name="todo-category">
          @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
          @endforeach
        </select>
        <button type="submit" class="bg-violet-500 text-white rounded-md px-4 py-2">Add todo</button>
      </form>

    </main>
  </x-app-layout>
@endsection
