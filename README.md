# tuerze-back-php
Jira-like app (php server)

### API general endpoint = http://localhost/tuerze-back/

## GITHUB

### API endpoint = http://localhost/tuerze-back/github/

methods:
	* zen (gets quote) http://localhost/tuerze-back/github/zen.php
	* user_repo (gets user repos) http://localhost/tuerze-back/github/user_repo.php?user=${username}

## USER

### API endpoint = http://localhost/tuerze-back/usuario/

methods:
	* create http://localhost/tuerze-back/usuario/create.php 
		add object as body
		{
      id_user,
      display_name,
      username,
      pic_url
   	}
	* read http://localhost/tuerze-back/usuario/read.php 
	* read one http://localhost/tuerze-back/usuario/read_one.php?id_user=${id_user}

## PROJECT

### API endpoint = http://localhost/tuerze-back/proyecto/

methods:
	* create http://localhost/tuerze-back/proyecto/create.php 
		add object as body
		{
      id_user,
      name_proyecto
    }
  * update http://localhost/tuerze-back/proyecto/update.php?id_proyecto=${id_proyecto}
		add object as body
		{
      id_user,
      name_proyecto
    }
	* read http://localhost/tuerze-back/proyecto/read.php?id_user=${id_user}
	* read one http://localhost/tuerze-back/proyecto/read_one.php?id_proyecto=${id_proyecto}
	* delete http://localhost/tuerze-back/proyecto/delete.php?id_proyecto=${id_proyecto}

## STORY

### API endpoint = http://localhost/tuerze-back/historia/

methods:
	* create http://localhost/tuerze-back/historia/create.php 
		add object as body
		{
      id_epica,
      name_hist,
      desc_hist,
      priority_hist,
      status_hist
    }
  * update http://localhost/tuerze-back/historia/update.php?id_hist=${id_hist}
		add object as body
		{
      id_epica,
      name_hist,
      desc_hist,
      priority_hist,
      status_hist
    }
	* read http://localhost/tuerze-back/historia/read.php?id_user=${id_user}
	* read one http://localhost/tuerze-back/historia/read_one.php?id_hist=${id_hist}
	* delete http://localhost/tuerze-back/historia/delete.php?id_hist=${id_hist}

## REPOSITORY

### API endpoint = http://localhost/tuerze-back/repositorio/

methods:
	* create http://localhost/tuerze-back/repositorio/create.php 
		add object as body
		{
      id_proyecto,
      URL_repo
    }
  * update http://localhost/tuerze-back/repositorio/update.php?id_repo=${id_repo}
		add object as body
		{
      id_proyecto,
      URL_repo
    }
	* read http://localhost/tuerze-back/repositorio/read.php?id_proyecto=${id_proyecto}
	* read one http://localhost/tuerze-back/repositorio/read_one.php?id_repo=${id_repo}
	* delete http://localhost/tuerze-back/repositorio/delete.php?id_repo=${id_repo}

## TASK

### API endpoint = http://localhost/tuerze-back/tarea/

methods:
	* create http://localhost/tuerze-back/tarea/create.php 
		add object as body
		{
      id_tarea,
      id_proyecto,
      id_epica,
      id_historia,
      name_tarea,
      desc_tarea,
      priority_tarea,
      status_tarea
    }
  * update http://localhost/tuerze-back/tarea/update.php?id_tarea=${id_tarea}
		add object as body
		{
      id_tarea,
      id_proyecto,
      id_epica,
      id_historia,
      name_tarea,
      desc_tarea,
      priority_tarea,
      status_tarea
    }
	* read http://localhost/tuerze-back/tarea/read.php?id_historia=${id_historia}
	* read one http://localhost/tuerze-back/tarea/read_one.php?id_tarea=${id_tarea}
	* delete http://localhost/tuerze-back/tarea/delete.php?id_tarea=${id_tarea}
