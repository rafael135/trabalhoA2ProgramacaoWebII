"use strict";
var __awaiter = (this && this.__awaiter) || function (thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
const lanchesContainer = document.querySelector("div#menu main");
const rememberToken = document.querySelector("input#rememberToken");
const csrfToken = document.querySelector("input[name='_token']");
const addLancheModal = document.querySelector("div#addLancheModal");
const formAddLanche = addLancheModal.querySelector("form#formAddLanche");
const addLancheNameInput = addLancheModal.querySelector("input#name");
const addLanchePriceInput = addLancheModal.querySelector("input#price");
const addLancheQuantityInput = addLancheModal.querySelector("input#quantity");
const addLancheDescriptionInput = addLancheModal.querySelector("textarea#description");
const addLancheImageInput = addLancheModal.querySelector("input#image");
const addLancheImageView = addLancheModal.querySelector("img#imageView");
const editLancheModal = document.querySelector("div#editLancheModal");
const editLancheLoadingStatus = editLancheModal.querySelector("div#loadingStatus");
const formEditLanche = editLancheModal.querySelector("form#formEditLanche");
const editLancheNameInput = editLancheModal.querySelector("input#name");
const editLanchePriceInput = editLancheModal.querySelector("input#price");
const editLancheQuantityInput = editLancheModal.querySelector("input#quantity");
const editLancheDescriptionInput = editLancheModal.querySelector("textarea#description");
const editLancheImageInput = editLancheModal.querySelector("input#image");
const editLancheImageView = editLancheModal.querySelector("img#imageView");
const simulateVendaModal = document.querySelector("div#simulateVendaModal");
const simulateVendaLoadingStatus = simulateVendaModal.querySelector("div#loadingStatus");
const formSimulateVenda = simulateVendaModal.querySelector("form#formSimulateVenda");
const simulateQuantityInput = formSimulateVenda.querySelector("input#quantity");
const simulateDateInput = formSimulateVenda.querySelector("input#date");
const editLancheModalBtn = editLancheModal.querySelector("button#editLancheModalBtn");
const simulateVendaModalBtn = simulateVendaModal.querySelector("button#simulateVendaModalBtn");
let selectedLancheId = null;
let selectedLanche = null;
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
const toggleUpdateLoadingStatus = (loading) => {
    if (loading == true) {
        editLancheLoadingStatus.style.display = "flex";
    }
    else {
        editLancheLoadingStatus.style.display = "none";
    }
};
const toggleSimulateLoadingStatus = (loading) => {
    if (loading == true) {
        simulateVendaLoadingStatus.style.display = "flex";
    }
    else {
        simulateVendaLoadingStatus.style.display = "none";
    }
};
const resetSelectedLanche = () => {
    selectedLancheId = null;
    selectedLanche = null;
};
addLancheImageInput.addEventListener("change", (e) => __awaiter(void 0, void 0, void 0, function* () {
    if (addLancheImageInput.files == null || addLancheImageInput.files.length == 0) {
        return;
    }
    let fileReader = new FileReader();
    fileReader.readAsDataURL(addLancheImageInput.files.item(0));
    fileReader.addEventListener("load", (e) => {
        addLancheImageView.src = fileReader.result.toString();
    });
}));
formAddLanche.addEventListener("submit", (e) => {
});
editLancheImageInput.addEventListener("change", (e) => __awaiter(void 0, void 0, void 0, function* () {
    if (editLancheImageInput.files == null || editLancheImageInput.files.length == 0) {
        return;
    }
    let fileReader = new FileReader();
    fileReader.readAsDataURL(editLancheImageInput.files.item(0));
    fileReader.addEventListener("load", (e) => {
        editLancheImageView.src = fileReader.result.toString();
    });
}));
formEditLanche.addEventListener("submit", (e) => __awaiter(void 0, void 0, void 0, function* () {
    e.preventDefault();
    toggleUpdateLoadingStatus(true);
    let name = editLancheNameInput.value;
    let price = Number.parseFloat(editLanchePriceInput.value);
    let quantity = Number.parseInt(editLancheQuantityInput.value);
    let description = editLancheDescriptionInput.value;
    let image = null;
    if (editLancheImageInput.files != null && editLancheImageInput.files.length > 0) {
        image = editLancheImageInput.files.item(0);
    }
    let formData = new FormData();
    formData.append("_method", "PUT");
    formData.append("_token", csrfToken.value);
    formData.append("name", name);
    formData.append("price", price.toFixed(2));
    formData.append("quantity", quantity.toString());
    formData.append("description", description);
    formData.append("image", image !== null && image !== void 0 ? image : "");
    let req = yield fetch(route("api.putLanche", { id: selectedLancheId }), {
        method: "POST",
        body: formData,
        headers: {
            Authorization: rememberToken.value,
            "Accept": "application/json"
        },
        credentials: "omit"
    });
    let res = yield req.json();
    if (res.status == 200) {
        let selectedLancheName = selectedLanche.querySelector("p.lanche-name");
        let selectedLancheDescription = selectedLanche.querySelector("p.lanche-description");
        let selectedLanchePrice = selectedLanche.querySelector("p.lanche-price");
        let selectedLancheImage = selectedLanche.querySelector("img.lanche-img");
        selectedLancheName.textContent = res.lanche.name;
        selectedLancheDescription.textContent = res.lanche.description;
        selectedLanchePrice.textContent = `R$ ${res.lanche.price.toString()}`;
        selectedLancheImage.src = res.lanche.image_url;
    }
    toggleUpdateLoadingStatus(false);
    resetSelectedLanche();
    editLancheModalBtn.click();
}));
formSimulateVenda.addEventListener("submit", (e) => __awaiter(void 0, void 0, void 0, function* () {
    e.preventDefault();
    if (selectedLancheId == null) {
        return;
    }
    toggleSimulateLoadingStatus(true);
    let quantity = Number.parseInt(simulateQuantityInput.value);
    let date = simulateDateInput.value;
    let req = yield fetch(route("api.createVenda"), {
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
    let res = yield req.json();
    if (res.status == 201) {
        simulateVendaModalBtn.click();
    }
    toggleSimulateLoadingStatus(false);
    resetSelectedLanche();
}));
function getLanche() {
    return __awaiter(this, void 0, void 0, function* () {
        toggleUpdateLoadingStatus(true);
        let req = yield fetch(route("api.getLanche", { id: selectedLancheId }), {
            method: "GET",
            headers: {
                Authorization: rememberToken.value
            },
            credentials: "omit"
        });
        let res = yield req.json();
        if (res.status == 200) {
            editLancheNameInput.value = res.lanche.name;
            editLancheDescriptionInput.value = res.lanche.description;
            editLanchePriceInput.value = res.lanche.price.toFixed(2);
            editLancheQuantityInput.value = res.lanche.quantity.toString();
            editLancheImageView.src = res.lanche.image_url;
        }
        toggleUpdateLoadingStatus(false);
    });
}
function selectLancheUpdate(btn) {
    selectedLancheId = Number.parseInt(btn.getAttribute("data-id"));
    selectedLanche = document.querySelector(`div.lanche[data-id='${selectedLancheId}']`);
    resetEditForm();
    getLanche();
}
function selectLancheSimulateVenda(btn) {
    selectedLancheId = Number.parseInt(btn.getAttribute("data-id"));
    resetSimulateVendaForm();
}
function selectLancheDelete(btn) {
    selectedLancheId = Number.parseInt(btn.getAttribute("data-id"));
    selectedLanche = document.querySelector(`div.lanche[data-id='${selectedLancheId}']`);
}
function confirmDeleteLanche() {
    return __awaiter(this, void 0, void 0, function* () {
        if (selectedLancheId == null || selectedLanche == null) {
            return;
        }
        let req = yield fetch(route("api.deleteLanche", { id: selectedLancheId }), {
            method: "DELETE",
            headers: {
                Authorization: rememberToken.value
            },
            credentials: "omit"
        });
        let res = yield req.json();
        if (res.status == 200) {
            selectedLanche.remove();
        }
    });
}
