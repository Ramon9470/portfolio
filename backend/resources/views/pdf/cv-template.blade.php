<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Currículo Ramon Ferreira</title>
    <style>
        body { 
            font-family: 'DejaVu Sans', sans-serif; 
            margin: 0; 
            padding: 0; 
            color: #333; 
        }

        .container { 
            width: 100%; 
            height: 100%; 
            osition: relative; 
        }
        
        /* Coluna Esquerda (Sidebar) */
        .sidebar { 
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 30%; 
            background-color: #e2e8f0;
            padding: 30px 20px;
            border-right: 1px solid #cbd5e0; 
        }
        
        /* Coluna Direita (Conteúdo) */
        .main-content { 
            position: absolute;
            right: 0;
            top: 0;
            bottom: 0;
            width: 63%;
            padding: 40px 30px; 
        }

        /* Foto */
        .profile-container { 
            text-align: center; 
            margin-bottom: 30px; 
        }
    
        .profile-img { 
            width: 140px; height: 140px; 
            border-radius: 50%; 
            object-fit: cover; 
            border: 5px solid #fff;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        /* Títulos */
        h1 { 
            font-size: 26px; 
            text-transform: uppercase; 
            margin: 0; color: #000; 
            letter-spacing: 1px; 
        }

        h2 { font-size: 14px; 
            text-transform: uppercase; 
            color: #666; 
            margin-top: 5px; 
            margin-bottom: 30px; 
            letter-spacing: 2px; 
        }
        
        h3 { 
            font-size: 14px; 
            text-transform: uppercase; 
            border-bottom: 2px solid #333; 
            padding-bottom: 5px; 
            margin-bottom: 15px; 
            margin-top: 25px;
            letter-spacing: 1px;
        }

        /* Sidebar Items */
        .contact-info { 
            font-size: 12px; 
            margin-bottom: 30px; 
            line-height: 1.6; 
        }

        .contact-item { 
            margin-bottom: 8px; 
        }

        .icon { 
            display: inline-block; 
            width: 15px; 
            margin-right: 5px; 
            font-weight: bold; 
        }

        .skill-list, .lang-list { 
            list-style: none; 
            padding: 0; 
            margin: 0; 
        }

        .skill-item { 
            margin-bottom: 10px; 
            font-size: 12px; 
        }
        
        /* Barras de progresso simuladas (Visual do Alejandro) */
        .progress-bar { 
            background: #ddd; 
            height: 6px; 
            width: 100%; 
            margin-top: 3px; 
            border-radius: 3px; 
        }

        .progress-fill { 
            background: #2d3748; 
            height: 100%; 
            width: 80%; 
            border-radius: 3px; 
        }

        /* Main Content Items */
        .section-text { 
            font-size: 12px; 
            line-height: 1.5; 
            text-align: justify; 
            color: #444; 
        }
        
        .exp-item { 
            margin-bottom: 20px; 
        }

        .job-title { 
            font-weight: bold; 
            font-size: 14px; 
            display: block; 
        }

        .job-company { 
            font-size: 12px; 
            font-style: italic; 
            color: #555; 
            margin-bottom: 5px; 
            display: block; 
        }

        .job-desc { 
            font-size: 12px; 
            color: #444; 
        }

        .course-item { 
            margin-bottom: 10px; 
        }

        .course-name { 
            font-weight: bold; 
            font-size: 13px; 
        }

        .course-school { 
            font-size: 12px; 
            color: #666; 
        }
        
    </style>
</head>
<body>

<table class="container" cellpadding="0" cellspacing="0">
    <tr>
        <td class="sidebar">
            <div style="text-align: center;">
                 <img src="{{ public_path('assets/images/foto.png') }}" class="profile-img" alt="Foto">
            </div>

            <h3>Contato</h3>
            <div class="contact-info">
                <div class="contact-item"> {{ $info->phone }}</div>
                <div class="contact-item"> {{ $info->email }}</div>
                <div class="contact-item"> {{ $info->city }} - {{ $info->state }}</div>
                <div class="contact-item"> linkedin.com/in/ramon-ferreira</div>
            </div>

            <h3>Habilidades</h3>
            <ul class="skill-list">
                @foreach($info->skills as $skill)
                <li class="skill-item">
                    {{ $skill }}
                    <div class="progress-bar"><div class="progress-fill" style="width: {{ rand(70, 95) }}%"></div></div>
                </li>
                @endforeach
            </ul>

            <h3>Idiomas</h3>
            <ul class="lang-list">
                @foreach($info->languages as $lang)
                <li class="skill-item">
                    {{ $lang }}
                    <div class="progress-bar"><div class="progress-fill" style="width: {{ str_contains($lang, 'Nativo') ? '100' : '60' }}%"></div></div>
                </li>
                @endforeach
            </ul>
        </td>

        <td class="main">
            <h1>{{ $info->full_name }}</h1>
            <h2>{{ $info->title }}</h2>

            <h3>Perfil</h3>
            <p class="section-text">
                {{ $info->summary }}
            </p>

            <h3>Experiência Profissional</h3>
            @foreach($experiences as $xp)
            <div class="exp-item">
                <span class="job-title">{{ $xp->role }}</span>
                <span class="job-company">{{ $xp->company }} | {{ $xp->period }}</span>
                <div class="job-desc">{{ $xp->description }}</div>
            </div>
            @endforeach

            <h3>Formação e Cursos</h3>
            @foreach($courses as $course)
            <div class="course-item">
                <div class="course-name">{{ $course->name }}</div>
                <div class="course-school">{{ $course->institution }} ({{ $course->status }})</div>
            </div>
            @endforeach
        </td>
    </tr>
</table>

</body>
</html>