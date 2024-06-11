@extends('errors::minimal')

@section('title', __('403'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'Tidak Memiliki Hak Akses'))
