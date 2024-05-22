<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClasseRequest;
use App\Models\Classe;
use App\Models\Course;
use Exception;
use Illuminate\Http\Request;

class ClasseController extends Controller
{
    public function index(Course $course)
    {
        
        // Recuperar as aulas do banco de dados
        $classes = Classe::with('course')
            ->where('course_id', $course->id)
            ->orderBy('order_classe')
            ->get();

        // Carregar a VIEW
        return view('classes.index', ['course'=> $course,'classes' => $classes]);
    }

     // Detalhes da aula
     public function show(Classe $classe)
     {
         // Carregar a VIEW
         return view('classes.show', ['classe' => $classe]);
     }

    //Carregar o formulario cadstrar nova aula
    public function create(Course $course)
    {
        //Carrega a view.
        return view('classes.create', ['course' => $course]);
    }

    //cadastrar no banco de dados a nova aula
    public function store(ClasseRequest $request)
    {
        //VAlidar o formulario
        $request->validated();

        // Marca o ponto inicial de uma transação
        DB::beginTransaction();

        try {

            // Recuperar a última ordem da aula no curso
            $lastOrderClasse = Classe::where('course_id', $request->course_id)
                ->orderBy('order_classe', 'DESC')
                ->first();
            // dd($lastOrderClasse);

            // Cadastrar no banco de dados na tabela aulas
            Classe::create([
                'name' => $request->name,
                'description' => $request->description,
                'order_classe' => $lastOrderClasse ? $lastOrderClasse->order_classe + 1 : 1,
                'course_id' => $request->course_id
            ]);

            // Operação é concluída com êxito
            DB::commit();

            // Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('classe.index', ['course' => $request->course_id])->with('success', 'Aula cadastrada com sucesso!');
        } catch (Exception $e) {

            // Operação não é concluída com êxito
            DB::rollBack();

            // Redirecionar o usuário, enviar a mensagem de erro
            return back()->withInput()->with('error', 'Aula não cadastrada!');
        }   
    }


    // Carregar o formulario editar aula.
    public function edit( Classe $classe)
    {

        // Carregar a view
        return view('classes.edit', ['classe' => $classe]);
    }

    public function update(ClasseRequest $request, Classe $classe)
    {

        // Validar o formulário
        $request->validated();

        // Marca o ponto inicial de uma transação
        DB::beginTransaction();

        try {

            // Editar as informações do registro no banco de dados
            $classe->update([
                'name' => $request->name,
                'description' => $request->description,
            ]);

            // Operação é concluída com êxito
            DB::commit();

            // Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('classe.index', ['course' => $classe->course_id])->with('success', 'Aula editada com sucesso!');
        } catch (Exception $e) {

            // Operação não é concluída com êxito
            DB::rollBack();

            // Redirecionar o usuário, enviar a mensagem de erro
            return back()->withInput()->with('error', 'Aula não editada!');
        }
    }

    // Apagar a aula do registro e bd>
        
    public function destroy(Classe $classe)
    {

        try{
            // Excluir o registro do Banco de dados
            $classe->delete();

            // Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('classe.index', ['course' => $classe->course_id ])->with('success', 'Aula apagada com sucesso!');

        } catch (Exception $e) {

            // Redirecionar o usuário, enviar a mensagem de Erro
            return redirect()->route('classe.index', ['course' => $classe->course_id ])->with('error', 'Aula não apagada!');

        }
        
        
    }

}
