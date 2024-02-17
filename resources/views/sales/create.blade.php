<x-app>
  <div class="flex justify-between">
    <h1 class="sm:text-xl font-bold text-gray-600 text-xs">Cadastre uma nova venda</h1>

    <a href="{{route('sales.index')}}" class="text-sm text-indigo-500">Listagem das vendas</a>
  </div>
  <div class="w-full bg-white p-10 mt-2 shadow rounded">
    <div class="text-xs p-2 text-yellow-800 rounded-lg bg-yellow-50 w-25" role="alert">
      <span class="font-medium">Alerta!</span>
      é necessário adicionar ao menos um produto para concretizar uma venda. 
    </div>
    <div class="mt-8">
      <div class="flow-root">
        <ul role="list" class="-my-6 divide-y divide-gray-200">
          @foreach ($products as $p)
            <li class="flex py-6">
              <div class="ml-4 flex flex-1 flex-col">
                <div>
                  <div class="flex justify-between text-base font-medium text-gray-900">
                    <h3>
                      <a href="#">{{$p->name}}</a>
                    </h3>
                    <p class="ml-4">${{$p->price}}</p>
                  </div>
                </div>
                <div class="product" 
                  data-product-id="{{$p->id}}" 
                  data-product-quantity="{{$p->quantity}}"
                  data-product-name="{{$p->name}}"
                  data-product-price="{{$p->price}}">
                  <div class="flex flex-1 items-end justify-between text-sm">
                    <p class="text-gray-500">Quantidade {{$p->quantity}}</p>
            
                    <div class="flex">
                      <button class="rounded bg-gray-200 px-2 increment">+</button>
                      <button class="rounded bg-gray-200 px-2 ml-1 decrement">-</button>
                    </div>
                  </div>
                  <div class="flex flex-row-reverse">
                      <p class="text-sm display"><span class="quantity" data-product-id="{{$p->id}}">0</span></p>
                  </div>
                </div>
              </div>
            </li>
          @endforeach
        </ul>
        <hr class="border-dashed mt-4">
        <div id="showResultTotal" class="flex justify-between">
            <div class="text-xs p-2 text-green-800 rounded-lg bg-green-50 w-25 border mt-2" role="alert" style="display: none" id="exibiTotal">
              <span class="text-xs">Total:</span>
              <b id="resTotal">R$: </b>
            </div>
            <div>
              <button id="saveButton" type="submit"class="rounded bg-red-500 hover:bg-red-600 px-1 text-white text-xs font-bold flex items-center mt-2">Calcular</button>
            </div>
        </div>
        <form id="formSalvar" method="POST" style="display: none">
          @csrf
          <input type="hidden" name="_token" value="{{ csrf_token() }}" id="_token">
          <div class="flex mt-2">
              <div class="flex flex-col w-full">
                  <label for="complemento" class="text-gray-600 text-sm">Cliente</label>
                  <select name="cliente_id" id="cliente_id" class="p-1.5 w-full border rounded outline-none text-sm bg-white">
                      <option value="">Selecione o cliente</option>
                      @foreach ($clients as $client)
                          <option value="{{ $client->id }}">{{ $client->name }}</option>
                      @endforeach
                  </select>
              </div>
              <div class="flex flex-col w-full ml-2">
                  <label for="complemento" class="text-gray-600 text-sm">Quantidade de parcelas</label>
                  <select required name="parcelas" id="parcelas" name="parcelas" class="p-1.5 w-full border rounded outline-none text-sm bg-white">
                      <option value="1">1X</option>
                      <option value="2">2X</option>
                      <option value="3">3X</option>
                      <option value="4">4X</option>
                      <option value="5">5X</option>
                      <option value="6">6X</option>
                  </select>
              </div>
          </div>
          <div id="dynamicFields" class="mt-2">
              <!-- Campos de data e valor serão adicionados aqui dinamicamente -->
          </div>
          <div class="flex flex-row-reverse">
              <button id="salvaVenda" type="submit" class="rounded bg-blue-500 hover:bg-blue-600 px-1.5 text-white text-sm font-bold flex items-center mt-2">Salvar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</x-app>

<script>
const quantityElements = document.querySelectorAll('.quantity');
const displayElements = document.querySelectorAll('.display');
const incrementButtons = document.querySelectorAll('.increment');
const decrementButtons = document.querySelectorAll('.decrement');

let cart = []; 

document.getElementById("parcelas").addEventListener("change", function() {
  let selectedValue = parseInt(this.value);
  let dynamicFields = document.getElementById("dynamicFields");
  
  // Limpa os campos dinâmicos existentes
  dynamicFields.innerHTML = "";
  
  // Adiciona novos campos de data e valor de acordo com o número de parcelas selecionado
  for (let i = 0; i < selectedValue; i++) {
      dynamicFields.innerHTML += `
          <div class="flex mt-2">
              <div class="flex flex-col w-full">
                  <label for="complemento" class="text-gray-600 text-sm">Data de pagamento</label>
                  <input type="date" required name="date[]" id="date[]" class="p-1 w-full border rounded outline-none text-sm bg-white">
              </div>
              <div class="flex flex-col w-full ml-2">
                  <label for="complemento" class="text-gray-600 text-sm">Valor</label>
                  <input type="text" required name="valorParcela[]" id="valorParcela[]" placeholder="Digite o valor (apenas números)" class="p-1.5 w-full border rounded outline-none text-sm bg-white" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
              </div>
          </div>
      `;
  }
});

// Função para adicionar produto ao carrinho
function addToCart(product) {
  cart.push(product);
}

function calculateTotal() {
  let total = 0;
  cart.forEach(product => {
    total += product.price;
  });
  formSalvar.style.display = total > 0 ? 'block' : 'none'; //exibi o formulario para selecionar o cliente caso adicionou um produto na lista
  exibiTotal.style.display = total > 0 ? 'block' : 'none'; //exibi o formulario para selecionar o cliente caso adicionou um produto na lista

  return total;
}

function updateTotalDisplay() {
  const total = calculateTotal();
  const resTotalElement = document.getElementById('resTotal');
  resTotalElement.textContent = `R$: ${total.toFixed(2)}`; // Exibe o valor total formatado com duas casas decimais
}

const saveButton = document.getElementById('saveButton');
saveButton.addEventListener('click', () => {
  updateTotalDisplay(); // Atualiza o valor total quando o usuário clicar em salvar
});

// Função para remover produto do carrinho
function removeFromCart(productId) {
  const index = cart.findIndex(product => product.id === productId);
  if (index !== -1) {
      cart.splice(index, 1);
  }
}

// Atualizar a exibição do carrinho
function updateCartDisplay() {
// Aqui você pode fazer o que quiser com o array 'cart'
console.log(cart);
}

incrementButtons.forEach(button => {
  button.addEventListener('click', () => {
      const productElement = button.closest('.product');
      const productId = productElement.dataset.productId;
      const productName = productElement.dataset.productName; 
      const productPrice = parseFloat(productElement.dataset.productPrice);
      const quantityTotal = parseInt(productElement.dataset.productQuantity);
      const quantityElement = document.querySelector(`.quantity[data-product-id="${productId}"]`);
      let quantity = parseInt(quantityElement.textContent);

      if (quantity >= quantityTotal) {
        return;
      }
      quantity++;
      quantityElement.textContent = quantity;
      addToCart({ id: productId, name: productName, price: productPrice, quantity: quantity }); // Adicionando objeto completo do produto ao carrinho
      updateCartDisplay(); // Atualizar a exibição do carrinho
  });
});

decrementButtons.forEach(button => {
  button.addEventListener('click', () => {
      const productId = button.closest('.product').dataset.productId;
      const quantityElement = document.querySelector(`.quantity[data-product-id="${productId}"]`);
      let quantity = parseInt(quantityElement.textContent);
      if (quantity > 0) {
          quantity--;
          quantityElement.textContent = quantity;
          removeFromCart(productId); // Remover produto do carrinho
          updateCartDisplay(); // Atualizar a exibição do carrinho
      }
  });
});

document.getElementById("formSalvar").addEventListener("submit", async function(event) {
    event.preventDefault();
    var salvaVenda = document.getElementById("salvaVenda");
    salvaVenda.disabled = true;
    salvaVenda.textContent = 'Salvando...';

    const clienteId = document.getElementById('cliente_id').value;
    const valorParcelaElements = document.getElementsByName('valorParcela[]');
    const parcelas = document.getElementById('parcelas').value;
    const dataPagamentoElements = document.getElementsByName('date[]');
    const csrfToken = document.getElementById("_token").value;

    // Extrair os valores dos elementos
    const valorParcela = [];
    valorParcelaElements.forEach(element => {
      valorParcela.push(element.value);
    });

    let elementoValorTotalDaSomaDosProdutos = document.getElementById("resTotal");
    if (elementoValorTotalDaSomaDosProdutos) {
        let valorTexto = elementoValorTotalDaSomaDosProdutos.textContent;
        let valor = valorTexto.replace("R$:", "").trim();
        
        const somaValorParcela = valorParcela.reduce((total, valor) => total + parseFloat(valor), 0);
        // Verificar se o valor total dos produtos é igual à soma das parcelas
        if (parseFloat(valor) !== somaValorParcela) {
          salvaVenda.disabled = false;
          salvaVenda.textContent = 'Salvar';
          return alert("Valor de parcelas inválido! O valor total dos produtos não é igual à soma das parcelas")
        }
    }

    const dataPagamento = [];
    dataPagamentoElements.forEach(element => {
        dataPagamento.push(element.value);
    });

    try {
        const response = await fetch('http://localhost:8000/sales/create', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'accept': 'application/json'
            },
            body: JSON.stringify({
                clienteId: clienteId,
                valorParcela: valorParcela,
                dataPagamento: dataPagamento,
                produtos: cart,
                _token: csrfToken
            })
        });

        if (response.status === 422) {
          alert('Você já realizou a venda desse produto')
        }

        if (response.status === 200) {
          alert('Venda realizada com sucesso! :)')
          window.location.href = 'http://localhost:8000/sales'
        }

    } catch (error) {
        console.log(error);
    } finally {
        salvaVenda.disabled = false;
        salvaVenda.textContent = 'Salvar';
    }
});


</script>
