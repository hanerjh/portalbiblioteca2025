<div>
    <h1>Hola laravel 12 
        <x-slot:cabecera>
            esta es la cabera 
        </x-slot>
    @for($i=0; $i<=3; $i++)
    <x-home>
       este es el valor del componente {{$i}}
    </x-home>
    @endfor
    
   
</div>
