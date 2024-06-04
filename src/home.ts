
type Lanche = {
    id: number;
    user_id: number;
    name: string;
    description: string;
    image_url: string;
    price: number;
    quantity: number;
    created_at: string;
    updated_at: string;
}

type InputError = {
    target: string;
    msg: string;
}

const lanchesContainer = document.querySelector("div#menu main") as HTMLDivElement;

const rememberToken = document.querySelector("input#rememberToken") as HTMLInputElement;
const csrfToken = document.querySelector("input[name='_token']") as HTMLInputElement;

const addLancheModal = document.querySelector("div#addLancheModal") as HTMLDivElement;


const formAddLanche = addLancheModal.querySelector("form#formAddLanche") as HTMLFormElement;
const addLancheNameInput = addLancheModal.querySelector("input#name") as HTMLInputElement;
const addLanchePriceInput = addLancheModal.querySelector("input#price") as HTMLInputElement;
const addLancheQuantityInput = addLancheModal.querySelector("input#quantity") as HTMLInputElement;
const addLancheDescriptionInput = addLancheModal.querySelector("textarea#description") as HTMLTextAreaElement;
const addLancheImageInput = addLancheModal.querySelector("input#image") as HTMLInputElement;
const addLancheImageView = addLancheModal.querySelector("img#imageView") as HTMLImageElement;

const editLancheModal = document.querySelector("div#editLancheModal") as HTMLDivElement;
const editLancheLoadingStatus = editLancheModal.querySelector("div#loadingStatus") as HTMLDivElement;

const formEditLanche = editLancheModal.querySelector("form#formEditLanche") as HTMLFormElement;
const editLancheNameInput = editLancheModal.querySelector("input#name") as HTMLInputElement;
const editLanchePriceInput = editLancheModal.querySelector("input#price") as HTMLInputElement;
const editLancheQuantityInput = editLancheModal.querySelector("input#quantity") as HTMLInputElement;
const editLancheDescriptionInput = editLancheModal.querySelector("textarea#description") as HTMLTextAreaElement;
const editLancheImageInput = editLancheModal.querySelector("input#image") as HTMLInputElement;
const editLancheImageView = editLancheModal.querySelector("img#imageView") as HTMLImageElement;


const simulateVendaModal = document.querySelector("div#simulateVendaModal") as HTMLDivElement;
const simulateVendaLoadingStatus = simulateVendaModal.querySelector("div#loadingStatus") as HTMLDivElement;

const formSimulateVenda = simulateVendaModal.querySelector("form#formSimulateVenda") as HTMLFormElement;
const simulateQuantityInput = formSimulateVenda.querySelector("input#quantity") as HTMLInputElement;
const simulateDateInput = formSimulateVenda.querySelector("input#date") as HTMLInputElement;

const editLancheModalBtn = editLancheModal.querySelector("button#editLancheModalBtn") as HTMLButtonElement;
const simulateVendaModalBtn = simulateVendaModal.querySelector("button#simulateVendaModalBtn") as HTMLButtonElement;

let selectedLancheId: null | number = null;
let selectedLanche: null | HTMLDivElement = null;

function resetEditForm() {
    editLancheNameInput.value = "";
    editLancheDescriptionInput.value = "";
    editLanchePriceInput.value = "0,00";
    editLancheQuantityInput.value = "";
    editLancheImageView.src = "";
}

function resetAddForm() {
    addLancheNameInput.value = "";
    addLancheDescriptionInput.value = "";
    addLanchePriceInput.value = "0,00";
    addLancheQuantityInput.value = "";
    addLancheImageView.src = "";
}

function resetSimulateVendaForm() {
    simulateQuantityInput.value = "0";
    simulateDateInput.value = "";
}


const toggleUpdateLoadingStatus = (loading: boolean) => {
    if(loading == true) {
        editLancheLoadingStatus.style.display = "flex";
    } else {
        editLancheLoadingStatus.style.display = "none";
    }
}

const toggleSimulateLoadingStatus = (loading: boolean) => {
    if(loading == true) {
        simulateVendaLoadingStatus.style.display = "flex";
    } else {
        simulateVendaLoadingStatus.style.display = "none";
    }
}

const resetSelectedLanche = () => {
    selectedLancheId = null;
    selectedLanche = null;
}


addLancheImageInput.addEventListener("change", async (e) => {
    if(addLancheImageInput.files == null || addLancheImageInput.files.length == 0) {
        return;
    }

    let fileReader = new FileReader();

    fileReader.readAsDataURL(addLancheImageInput.files.item(0)!);

    fileReader.addEventListener("load", (e) => {
        addLancheImageView.src = fileReader.result!.toString();
    });
});

formAddLanche.addEventListener("submit", (e) => {
    //e.preventDefault();
});


editLancheImageInput.addEventListener("change", async (e) => {
    if(editLancheImageInput.files == null || editLancheImageInput.files.length == 0) {
        return;
    }

    let fileReader = new FileReader();

    fileReader.readAsDataURL(editLancheImageInput.files.item(0)!);

    fileReader.addEventListener("load", (e) => {
        editLancheImageView.src = fileReader.result!.toString();
    });
});

type UpdateLancheResponse = {
    lanche: Lanche;
    status: number;
}

formEditLanche.addEventListener("submit", async (e) => {
    e.preventDefault();

    toggleUpdateLoadingStatus(true);

    let name = editLancheNameInput.value;
    let price = Number.parseFloat(editLanchePriceInput.value);
    let quantity = Number.parseInt(editLancheQuantityInput.value);
    let description = editLancheDescriptionInput.value;

    let image: File | null = null;
    if(editLancheImageInput.files != null && editLancheImageInput.files.length > 0) {
        image = editLancheImageInput.files.item(0) as File;
    }


    let formData = new FormData();

    formData.append("_method", "PUT"); // Solução bug PHP
    formData.append("_token", csrfToken.value);
    formData.append("name", name);
    formData.append("price", price.toFixed(2));
    formData.append("quantity", quantity.toString());
    formData.append("description", description);
    formData.append("image", image ?? "");

    // @ts-expect-error
    let req = await fetch(route("api.putLanche", { id: selectedLancheId }), {
        method: "POST", // Bug PHP, não lê requisições PUT "multipart/form-data", solução: utilizar "POST" e definir "_method=PUT" no formData
        body: formData,
        headers: {
            Authorization: rememberToken.value,
            "Accept": "application/json"
        },
        credentials: "omit"
    });

    let res: UpdateLancheResponse = await req.json();

    if(res.status == 200) {
        let selectedLancheName = selectedLanche!.querySelector("p.lanche-name") as HTMLParagraphElement;
        let selectedLancheDescription = selectedLanche!.querySelector("p.lanche-description") as HTMLParagraphElement;
        let selectedLanchePrice = selectedLanche!.querySelector("p.lanche-price") as HTMLParagraphElement;
        //let selectedLancheQuantity = selectedLanche!.querySelector("input#quantity") as HTMLInputElement;
        let selectedLancheImage = selectedLanche!.querySelector("img.lanche-img") as HTMLImageElement;

        selectedLancheName.textContent = res.lanche.name;
        selectedLancheDescription.textContent = res.lanche.description;
        selectedLanchePrice.textContent = `R$ ${res.lanche.price.toString()}`;
        selectedLancheImage.src = res.lanche.image_url;
    }

    toggleUpdateLoadingStatus(false);
    resetSelectedLanche();
    editLancheModalBtn.click();

});

type SimulateVendaResponse = {
    status: number;
}

formSimulateVenda.addEventListener("submit", async (e) => {
    e.preventDefault();

    if(selectedLancheId == null) {
        return;
    }

    toggleSimulateLoadingStatus(true);

    let quantity = Number.parseInt(simulateQuantityInput.value);
    let date = simulateDateInput.value;

    // @ts-expect-error
    let req = await fetch(route("api.createVenda"), {
        method: "POST",
        body: JSON.stringify({
            lanche_id: selectedLancheId,
            quantity: quantity,
            date: date
        }),
        headers: {
            "Content-Type": "application/json",
            Accept: "application/json",
            Authorization: rememberToken.value
        },
        credentials: "omit"
    });

    let res: SimulateVendaResponse = await req.json();

    if(res.status == 201) {
        simulateVendaModalBtn.click();
    }

    toggleSimulateLoadingStatus(false);
    resetSelectedLanche();
})

type GetLancheResponse = {
    lanche: Lanche;
    status: number;
};

async function getLanche() {
    toggleUpdateLoadingStatus(true);

    // @ts-expect-error
    let req = await fetch(route("api.getLanche", { id: selectedLancheId }), {
        method: "GET",
        headers: {
            Authorization: rememberToken.value
        },
        credentials: "omit"
    });

    let res: GetLancheResponse = await req.json();

    if(res.status == 200) {
        editLancheNameInput.value = res.lanche.name;
        editLancheDescriptionInput.value = res.lanche.description;
        editLanchePriceInput.value = res.lanche.price.toFixed(2);
        editLancheQuantityInput.value = res.lanche.quantity.toString();
        editLancheImageView.src = res.lanche.image_url;
    }

    toggleUpdateLoadingStatus(false);
}

function selectLancheUpdate(btn: HTMLButtonElement) {
    selectedLancheId = Number.parseInt(btn.getAttribute("data-id")!);
    selectedLanche = document.querySelector(`div.lanche[data-id='${selectedLancheId}']`);
    resetEditForm();

    getLanche();
}

function selectLancheSimulateVenda(btn: HTMLButtonElement) {
    selectedLancheId = Number.parseInt(btn.getAttribute("data-id")!);
    
    resetSimulateVendaForm();
}

function selectLancheDelete(btn: HTMLButtonElement) {
    selectedLancheId = Number.parseInt(btn.getAttribute("data-id")!);
    selectedLanche = document.querySelector(`div.lanche[data-id='${selectedLancheId}']`);
}


type DeleteLancheResponse = {
    status: number;
}

async function confirmDeleteLanche() {
    if(selectedLancheId == null || selectedLanche == null) {
        return;
    }

    // @ts-expect-error
    let req = await fetch(route("api.deleteLanche", { id: selectedLancheId }), {
        method: "DELETE",
        headers: {
            Authorization: rememberToken.value
        },
        credentials: "omit"
    });

    let res: DeleteLancheResponse = await req.json();

    if(res.status == 200) {
        selectedLanche.remove();
    }
}