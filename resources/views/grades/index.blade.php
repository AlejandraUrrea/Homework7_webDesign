<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control de Calificaciones</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; margin: 40px; background-color: #f0f2f5; color: #333; }
        .container { max-width: 900px; margin: auto; background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
        h1, h2 { color: #1a73e8; border-bottom: 2px solid #e8f0fe; padding-bottom: 10px; }
        
        /* Estilos de formulario */
        .section { margin-bottom: 30px; padding: 20px; border: 1px solid #e0e0e0; border-radius: 8px; }
        label { display: block; font-weight: bold; margin-bottom: 5px; color: #555; }
        select, input, textarea { width: 100%; padding: 12px; margin-bottom: 15px; border: 1px solid #ddd; border-radius: 6px; box-sizing: border-box; font-size: 14px; }
        
        /* Botones */
        .btn { padding: 12px 20px; border: none; border-radius: 6px; cursor: pointer; font-weight: bold; text-decoration: none; display: inline-block; transition: 0.3s; }
        .btn-add { background-color: #34a853; color: white; width: 100%; }
        .btn-add:hover { background-color: #2d8e47; }
        .btn-del { background-color: #ea4335; color: white; padding: 6px 12px; font-size: 12px; }
        .btn-del:hover { background-color: #d33426; }

        /* Tabla */
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { text-align: left; padding: 15px; border-bottom: 1px solid #eee; }
        th { background-color: #f8f9fa; color: #777; text-transform: uppercase; font-size: 12px; }
        tr:hover { background-color: #fcfcfc; }
        .score-badge { background: #e8f0fe; color: #1a73e8; padding: 5px 10px; border-radius: 4px; font-weight: bold; }
    </style>
</head>
<body>

<div class="container">
    <h1>Sistema de Calificaciones</h1>

    <div class="section">
        <form action="{{ route('grades.index') }}" method="GET">
            <label for="subject_id">Selecciona una Materia:</label>
            <select name="subject_id" id="subject_id" onchange="this.form.submit()">
                <option value="">-- Elige una materia de la lista --</option>
                @foreach($subjects as $sub)
                    <option value="{{ $sub->id }}" {{ (isset($selectedSubject) && $selectedSubject->id == $sub->id) ? 'selected' : '' }}>
                        {{ $sub->name }}
                    </option>
                @endforeach
            </select>
        </form>
    </div>

    @if($selectedSubject)
        <h2>Materia: {{ $selectedSubject->name }}</h2>

        <div class="section">
            <h3 style="margin-top:0">Añadir Actividad Evaluativa</h3>
            <form action="{{ route('grades.store') }}" method="POST">
                @csrf
                <input type="hidden" name="subject_id" value="{{ $selectedSubject->id }}">
                
                <div style="display: flex; gap: 15px;">
                    <div style="flex: 2;">
                        <label>Tipo de Actividad:</label>
                        <input type="text" name="activity_type" placeholder="Ej: Tarea, Examen, Quiz..." required>
                    </div>
                    <div style="flex: 1;">
                        <label>Calificación:</label>
                        <input type="number" step="0.1" min="0" max="10" name="score" placeholder="0.0" required>
                    </div>
                    <div style="flex: 1;">
                        <label>Fecha:</label>
                        <input type="date" name="date" required>
                    </div>
                </div>

                <label>Comentarios / Observaciones:</label>
                <textarea name="comments" rows="2" placeholder="Opcional..."></textarea>
                
                <button type="submit" class="btn btn-add">Registrar Calificación</button>
            </form>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Actividad</th>
                    <th>Fecha</th>
                    <th>Nota</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($grades as $g)
                <tr>
                    <td>
                        <strong>{{ $g->activity_type }}</strong><br>
                        <small style="color: #888;">{{ $g->comments }}</small>
                    </td>
                    <td>{{ $g->date }}</td>
                    <td><span class="score-badge">{{ $g->score }}</span></td>
                    <td>
                        <form action="{{ route('grades.destroy', $g->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-del" onclick="return confirm('¿Eliminar esta nota?')">Borrar</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" style="text-align: center; color: #999; padding: 40px;">
                        No hay actividades registradas para esta materia aún.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    @else
        <div style="text-align: center; padding: 40px; color: #666; border: 2px dashed #ddd; border-radius: 8px;">
            <p>Selecciona una materia del menú desplegable para gestionar sus actividades y calificaciones.</p>
        </div>
    @endif
</div>

</body>
</html>