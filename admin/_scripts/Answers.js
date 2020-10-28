class Answers{
    constructor(instanceName,answerIdPrefix,answerDivId,tdClassName1,answerPlaceholder,answerClassName,imageNodeText,imageClassName,correctAnswerDivId,answerMin,answerLimit){
        this.instanceName = instanceName;
        this.answerIdPrefix=answerIdPrefix;
        this.answerDiv=document.getElementById(answerDivId);
        this.tdClassName1=tdClassName1;
        this.answerPlaceholder=answerPlaceholder;
        this.answerClassName=answerClassName;
        this.imageNodeText=imageNodeText;
        this.imageClassName=imageClassName;
        this.correctAnswerDiv=document.getElementById(correctAnswerDivId);
        this.answerLimit=answerLimit;
        this.answerMin=answerMin;
        this.numberOfAnswers=0;
        var answerExists=true;
        while(answerExists==true){
            if(document.getElementById(answerIdPrefix+this.numberOfAnswers)){
                this.numberOfAnswers+=1;
            }
            else{
                answerExists=false;
            }
        }
    }
/////////////////////////GETS & SETS //////////////////////////////
    getNumberOfAnswers(){return this.numberOfAnswers;};
    setNumberOfAnswers(number){this.numberOfAnswers = number;};
    
    getAnswerIdPrefix(){return this.answerIdPrefix;}
    setAnswerIdPrefix(answerIdPrefix){this.answerIdPrefix = answerIdPrefix;};
    
    getAnswerDiv(){return this.answerDiv;};
    setAnswerDiv(answerDiv){this.answerDiv = answerDiv;};
    
    getTdClassName1(){return this.tdClassName1;};
    setTdClassName1(tdClassName1){this.tdClassName1 = tdClassName1;};
    
    getAnswerPlaceholder(){return this.answerPlaceholder;};
    setAnswerPlaceholder(answerPlaceholder){this.answerPlaceholder = answerPlaceholder;};
    
    getAnswerClassName(){return this.answerClassName;};
    setAnswerClassName(answerClassName){this.answerClassName = answerClassName;};
    
    getImageNodeText(){return this.imageNodeText;};
    setImageNodeText(imageNodeText){this.imageNodeText = imageNodeText;};
    
    getImageClassName(){return this.imageClassName;};
    setImageClassName(imageClassName){this.imageClassName = imageClassName;};

    getCorrectAnswerDiv(){return this.correctAnswerDiv;};
    setCorrectAnswerDiv(correctAnswerDiv){this.correctAnswerDiv = correctAnswerDiv;};
/////////////////////////OTHERS////////////////////////////
    addAnswer(){
        if(this.answerLimit==0||this.getNumberOfAnswers()<this.answerLimit){
            this.setNumberOfAnswers(this.getNumberOfAnswers()+1);

            //TD1 numero da resposta
            var newAnswerSpanNode = document.createTextNode(this.getNumberOfAnswers()+"-");
            var newAnswerSpan = document.createElement("span");
            newAnswerSpan.setAttribute("id",this.getAnswerIdPrefix()+"Span"+this.getNumberOfAnswers());
            newAnswerSpan.appendChild(newAnswerSpanNode);
            var newAnswerTd1 = document.createElement("td");
            newAnswerTd1.className = this.getTdClassName1();
            newAnswerTd1.appendChild(newAnswerSpan);
            
            //TD2 caixa de texto
            var newAnswer = document.createElement("advanced-textfield");
            newAnswer.setAttribute("id",this.getAnswerIdPrefix()+this.getNumberOfAnswers());
            newAnswer.setAttribute("name",this.getAnswerIdPrefix()+this.getNumberOfAnswers());
            newAnswer.childNodes[0].setAttribute("id",newAnswer.id+"Content");
            newAnswer.childNodes[0].setAttribute("name",newAnswer.id+"Content");
            newAnswer.className = this.getAnswerClassName();
            newAnswer.setAttribute("placeholder",this.getAnswerPlaceholder());
            newAnswer.setAttribute("form","questionForm");
            var newAnswerTd2 = document.createElement("td");
            newAnswerTd2.appendChild(newAnswer);
            
            //TD3 adicionar imagem
            var newAnswerAddImageNode = document.createTextNode(this.getImageNodeText());
            var newAnswerAddImage = document.createElement("button");
            newAnswerAddImage.appendChild(newAnswerAddImageNode);
            newAnswerAddImage.setAttribute("id",this.getAnswerIdPrefix()+"AddImage"+this.getNumberOfAnswers());
            newAnswerAddImage.setAttribute("name",this.getAnswerIdPrefix()+"AddImage"+this.getNumberOfAnswers());
            newAnswerAddImage.setAttribute("type","button");
            newAnswerAddImage.setAttribute("onclick",this.instanceName+".addImage(document.getElementById(\""+this.getAnswerIdPrefix()+this.getNumberOfAnswers()+"\").childNodes[0]);");
            newAnswerAddImage.className = this.getImageClassName();        
            var newAnswerTd3 = document.createElement("td");
            newAnswerTd3.appendChild(newAnswerAddImage);

            //Tr ou linha
            var newAnswerTr = document.createElement("tr");
            newAnswerTr.setAttribute("id",this.getAnswerIdPrefix()+"Tr"+this.getNumberOfAnswers());
            newAnswerTr.setAttribute("name",this.getAnswerIdPrefix()+"Tr"+this.getNumberOfAnswers());
            newAnswerTr.appendChild(newAnswerTd1);
            newAnswerTr.appendChild(newAnswerTd2);
            newAnswerTr.appendChild(newAnswerTd3);
            this.answerDiv.appendChild(newAnswerTr);

            //Correct Answer Option
            var newCorrectAnswerOption = document.createElement("option");
            newCorrectAnswerOption.setAttribute("id",this.getAnswerIdPrefix()+"CorrectOption"+this.getNumberOfAnswers());
            newCorrectAnswerOption.setAttribute("name",this.getAnswerIdPrefix()+"CorrectOption"+this.getNumberOfAnswers());
            newCorrectAnswerOption.text = this.getNumberOfAnswers();
            newCorrectAnswerOption.value = this.getNumberOfAnswers();
            this.correctAnswerDiv.appendChild(newCorrectAnswerOption);
        }
    }
    removeAnswer(){
        if(this.answerMin==0||this.getNumberOfAnswers()>this.answerMin){
            var tr = document.getElementById(this.getAnswerIdPrefix()+"Tr"+this.getNumberOfAnswers());
            tr.parentNode.deleteRow(this.numberOfAnswers-1);
            var CorrectAnswerOption = document.getElementById(this.getAnswerIdPrefix()+"CorrectOption"+this.getNumberOfAnswers());
            CorrectAnswerOption.parentNode.removeChild(CorrectAnswerOption);
            this.setNumberOfAnswers(this.numberOfAnswers-1);
        }
    }
    addImage(answerContent){
        if (!window.File || !window.FileReader || !window.FileList || !window.Blob) { //Testa a existência dos objetos no navegador
            alert('Impossível carregar imagem no seu navegador!');
            return; //Encerra a função
        }
        else{
            var fr = new FileReader(); //Cria um leitor de arquivo
            var fileSelector = document.createElement('input'); //Cria um input invisível na página
            fileSelector.setAttribute('type', 'file'); //Diz que o input é do tipo arquivo
            fileSelector.setAttribute('accept', 'image/jpeg,image/png'); //Diz que o input só aceita jpg ou png
            fileSelector.onclick = function () { //Zera o valor do input ao ser clicado
                this.value = null;
            };
            fileSelector.onchange = function(){ //Quando for carregado algum arquivo, é ativado a função como gatilho
                if (!fileSelector.files) { //Se não houver o atributo files, logo o navegador não suporta esse tipo de input
                    alert("Impossível carregar imagem no seu navegador!");
                    return 0;
                }
                else if (!fileSelector.files[0]) { //Se nenhum arquivo for adicionado, leva-se em consideração que o usuário cancelou a operação, portanto encerra a função
                    return 0;             
                }
                else{ //Se tudo ocorrer bem
                    fr.onload = function(){ //Determina o trigger onload para o fileReader, isso é necessário pois, precisa-se esperar que o mesmo carregue o result antes de enviá-lo para algum lugar
                        var image = document.createElement("img"); //Cria um elemento do tipo img
                        image.setAttribute("src",fr.result); //define o src como o base64 da imagem
                        answerContent.appendChild(image); //insere dentro do advanced-textfield
                    }
                    fr.readAsDataURL(fileSelector.files[0]); //Inicia a conversão para base64 que quando encerrado chamará a função onload
                }
            }
            fileSelector.click(); //Chama o file dialog que quando encerrado chamará a funcção onload
        }
    }
}