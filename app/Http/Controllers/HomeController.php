<?php

namespace App\Http\Controllers;

// use Carbon\Carbon;
use View;

class HomeController extends Controller
{
    public $layout = 'layouts.master';

    public function dashboardHome()
    {
        return view('dashboard.index');
    }

    public function dbHome()
    {
        return view('docs.db.index');
    }

    public function projectHome()
    {
        return view('docs.project.index');
    }

    public function elasticsearchHome()
    {
        return view('docs.elasticsearch.index');
    }

    public function testsHome()
    {
        return view('docs.tests.index');
    }

    public function laravelHome()
    {
        return view('docs.laravel.index');
    }

    public function laravelTodoHome()
    {
        return view('docs.laravel.todo');
    }

    public function technicalNotes()
    {
        return view('docs.technicalnotes.index');
    }

    public function apiDoc()
    {
        return view('docs.api.doc');
    }

    public function authorDocsHome()
    {
        return view('docs.author.index');
    }

    public function contactDocsHome()
    {
        return view('docs.author.contact');
    }

    public function testsApi()
    {
        return view('docs.test.api');
    }

    public function testsApp()
    {
        return view('docs.tests.app');
    }

    public function addDocsHome()
    {
        return view('docs.pages.crud.add');
    }

    public function authDocsHome()
    {
        return view('docs.pages.auth.index');
    }

    public function chartsDocsHome()
    {
        return view('docs.pages.charts.index');
    }

    public function dashboardDocsHome()
    {
        return view('docs.pages.dashboard.index');
    }

    public function editDocsHome()
    {
        return view('docs.pages.crud.edit');
    }

    public function oldStack()
    {
        return view('visits.index');
    }

    public function datarangeDocs()
    {
        return view('docs.pages.crud.daterange');
    }

    public function listDocsHome()
    {
        return view('docs.pages.list.index');
    }

    public function datageneratorDocsHome()
    {
        return view('docs.pages.datagenerator.index');
    }

    public function layoutDocsHome()
    {
        return view('docs.pages.layout.index');
    }

    public function stackDocsHome()
    {
        return view('docs.stack.index');
    }

    // CHARTS

    public function chartsHome()
    {
        return view('docs.interfaces.charts.index');
    }
}
