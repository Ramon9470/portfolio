<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Currículo - {{ $info->nome_completo }}</title>
    <style>
        @page { margin: 0; }
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
            background: #fff;
            line-height: 1.5;
        }

        /* --- LAYOUT --- */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            width: 280px;
            /* AJUSTE 1: Cor mais escura para dar contraste */
            background-color: #e2e8f0; 
            height: 100%;
        }

        .main {
            position: absolute;
            left: 280px;
            top: 0;
            right: 0;
            padding: 40px;
        }

        /* --- DECORAÇÃO TOPO (Triângulo Azul) --- */
        .sidebar-header-decoration {
            background-color: #0f172a;
            height: 180px;
            width: 100%;
            clip-path: polygon(0 0, 100% 0, 0 100%);
        }

        /* --- FOTO --- */
        .photo-container {
            position: absolute;
            top: 40px;
            left: 0;
            width: 100%;
            text-align: center;
            z-index: 10;
        }
        .profile-img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid #fff;
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
            background-color: #fff;
        }

        /* --- TEXTOS SIDEBAR --- */
        .sidebar-content {
            margin-top: 30px; 
            padding: 20px 30px;
        }

        .sidebar-section {
            margin-bottom: 25px;
        }

        .sidebar-title {
            text-transform: uppercase;
            font-weight: bold;
            font-size: 13px;
            letter-spacing: 1px;
            border-bottom: 2px solid #0f172a;
            padding-bottom: 5px;
            margin-bottom: 10px;
            color: #0f172a;
        }

        /* AJUSTE 3: Estilos para remover os '?' e usar texto */
        .contact-row {
            margin-bottom: 8px;
            font-size: 11px;
            color: #334155;
        }
        .contact-label {
            font-weight: bold;
            color: #0f172a;
            display: block; /* Label em cima */
            font-size: 10px;
            text-transform: uppercase;
        }
        .contact-value {
            display: block;
            word-wrap: break-word;
        }

        /* Barras de Progresso */
        .skill-list { list-style: none; padding: 0; margin: 0; }
        .skill-item { margin-bottom: 8px; font-size: 11px; color: #334155; font-weight: bold; }
        .skill-bar {
            height: 4px;
            background-color: #cbd5e1;
            margin-top: 2px;
            border-radius: 2px;
            width: 100%;
        }
        .skill-fill {
            height: 100%;
            background-color: #0f172a;
            border-radius: 2px;
        }

        /* --- CONTEÚDO PRINCIPAL --- */
        .header-name h1 {
            font-size: 32px;
            text-transform: uppercase;
            margin: 0;
            color: #000;
            line-height: 1;
        }
        .header-name h2 {
            font-size: 14px;
            text-transform: uppercase;
            color: #0f172a;
            margin-top: 5px;
            margin-bottom: 30px;
            letter-spacing: 2px;
            font-weight: normal;
        }

        .main-section { margin-bottom: 25px; }
        .main-title {
            text-transform: uppercase;
            font-weight: bold;
            font-size: 13px;
            letter-spacing: 1px;
            border-bottom: 1px solid #94a3b8;
            padding-bottom: 5px;
            margin-bottom: 15px;
            color: #333;
        }

        .profile-text {
            font-size: 12px;
            text-align: justify;
            color: #4b5563;
        }

        .job-item { 
            margin-bottom: 15px; 
        }
        
        .job-title { 
            font-weight: bold; 
            font-size: 13px; 
            color: #000; 
        }

        .job-meta { 
            font-size: 11px; 
            color: #64748b; 
            margin-bottom: 3px; 
            font-style: italic; 
        }

        .job-desc { 
            font-size: 12px; 
            color: #4b5563; 
            text-align: justify; 
        }

    </style>
</head>
<body>

    <div class="sidebar">
        <div class="sidebar-header-decoration"></div>

        <div class="photo-container">
            <?php
                $path = null;
                if (!empty($info->perfil_foto_url)) {
                    $storagePath = storage_path('app/public/' . str_replace('/storage/', '', $info->perfil_foto_url));
                    if (file_exists($storagePath)) $path = $storagePath;
                }
                if (!$path) $path = public_path('assets/images/foto.png');
            ?>
            @if(file_exists($path))
                <img src="{{ $path }}" class="profile-img" alt="Foto">
            @endif
        </div>

        <div class="sidebar-content">
            
            <div class="sidebar-section">
                <div class="sidebar-title">Contato</div>
                
                <div class="contact-row">
                    <span class="contact-label">Telefone</span>
                    <span class="contact-value">{{ $info->telefone ?? '' }}</span>
                </div>
                <div class="contact-row">
                    <span class="contact-label">Email</span>
                    <span class="contact-value">{{ $info->email ?? '' }}</span>
                </div>
                <div class="contact-row">
                    <span class="contact-label">Endereço</span>
                    <span class="contact-value">{{ $info->cidade ?? '' }} - {{ $info->estado ?? '' }}</span>
                </div>
                
                @if(!empty($info->linkedin_url))
                <div class="contact-row">
                    <span class="contact-label">LinkedIn</span>
                    <span class="contact-value">linkedin.com/in/ramon</span>
                </div>
                @endif
                
                @if(!empty($info->github_url))
                <div class="contact-row">
                    <span class="contact-label">GitHub</span>
                    <span class="contact-value">github.com/Ramon9470</span>
                </div>
                @endif
            </div>

            @if(!empty($info->idiomas) && count($info->idiomas) > 0)
            <div class="sidebar-section">
                <div class="sidebar-title">Idiomas</div>
                <ul class="skill-list">
                    @foreach($info->idiomas as $idioma)
                    <li class="skill-item">
                        {{ $idioma }}
                        <div class="skill-bar"><div class="skill-fill" style="width: 80%"></div></div>
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif

            @if(!empty($info->habilidades) && count($info->habilidades) > 0)
            <div class="sidebar-section">
                <div class="sidebar-title">Habilidades</div>
                <ul class="skill-list">
                    @foreach($info->habilidades as $habilidade)
                    <li class="skill-item">
                        {{ $habilidade }}
                        <div class="skill-bar"><div class="skill-fill" style="width: {{ rand(60, 95) }}%"></div></div>
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif

        </div>
    </div>

    <div class="main">
        
        <div class="header-name">
            <h1>{{ $info->nome_completo ?? 'Ramon Ferreira' }}</h1>
            <h2>{{ $info->titulo ?? 'Desenvolvedor Full Stack' }}</h2>
        </div>

        <div class="main-section">
            <div class="main-title">Perfil</div>
            <div class="profile-text">
                {{ $info->resumo ?? '' }}
            </div>
        </div>

        @if(count($experiencias) > 0)
        <div class="main-section">
            <div class="main-title">Experiência Profissional</div>
            @foreach($experiencias as $exp)
            <div class="job-item">
                <div class="job-title">{{ $exp->cargo }}</div>
                <div class="job-meta">{{ $exp->empresa }} | {{ $exp->periodo }}</div>
                <div class="job-desc">{{ $exp->descricao }}</div>
            </div>
            @endforeach
        </div>
        @endif

        @if(count($cursos) > 0)
        <div class="main-section">
            <div class="main-title">Formação</div>
            @foreach($cursos as $curso)
            <div class="job-item">
                <div class="job-title">{{ $curso->titulo }}</div>
                <div class="job-meta">
                    {{ $curso->instituicao }} 
                    @if($curso->status) • {{ $curso->status }} @endif
                </div>
                @if($curso->tipo)
                <div class="job-desc">{{ $curso->tipo }}</div>
                @endif
            </div>
            @endforeach
        </div>
        @endif

    </div>

</body>
</html>