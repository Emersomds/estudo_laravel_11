<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CourseController extends Controller
{
    // Listar os cursos
    public function index(){
       //carregar a view
       return view('courses.index');
    }

    // Visualizar os cursos
    public function show(){
        
        return view('courses.show');
     }

     // Carregar o formulario cadastrar novo curso
    public function create(){
        
        return view('courses.create');
     }

     // Cadastrar no banco de dados
    public function store(){
        
        dd('cadsatrar  no Banco de Dados');
     }
 
     // Carrega o formulario para editar
    public function edit(){
        
        return view('courses.edit');
     }

     //Edita no Banco de Dados
     public function update(){
        
        dd("Editar o curso no Banco de Dados");
     }
 
     //Exclui no banco de dados
     public function destroy(){
        
        dd("Exclui o curso no Banco de Dados");
     }
 
}
