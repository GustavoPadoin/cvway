$(window).load(function(){

    //Group();
});

function deletar(id){

    bootbox.confirm({
      message: "Tem certeza que deseja deletar ?",
      callback: function(result){

          if (result == true){

              $('#form'+id).submit();

          }
        }
    });
}

function cover(id){

    bootbox.confirm({
      message: "Deseja tornar essa foto capa do álbum ?",
      callback: function(result){

          if (result == true){

              $('#formc'+id).submit();

          }
        }
    });
}
