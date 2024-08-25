window.addEventListener("load", () => {
  cards = document.getElementsByClassName("card");
  formatedCards = Array.from(cards).map((card) => {
    const [number, ...name] = card.innerText.split("$");
    return { number: number, name: name.join(" "), ref: card };
  });

  sliceArray(formatedCards, 75).map((formatedCardsSlices) => {
    fetch("https://api.scryfall.com/cards/collection", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        identifiers: formatedCardsSlices.map((card) => {
          return {
            name: card.name,
          };
        }),
      }),
    })
      .then((response) => response.json())
      .then((result) => {
        if (!result.status != null) updateCards(result, formatedCardsSlices);
      });
  });
});

function sliceArray(array, sliceSize) {
  let result = [];
  for (let i = 0; i < array.length; i += sliceSize) {
    result.push(array.slice(i, i + sliceSize));
  }
  return result;
}

function updateCards(result, cards) {
  Array.from(cards).map((card) => {
    if (
      result["not_found"].find(
        (element) => element.name.toLowerCase() == card.name.toLowerCase()
      )
    )
      return;

    const cardInformation = result.data.find(
      (element) => element.name.toLowerCase() == card.name.toLowerCase()
    );

    console.log(card.name.toLowerCase());

    const cardImg = document.createElement("img");
    cardImg.src = cardInformation["image_uris"].normal;
    cardImg.className = "cardImage";

    card.ref.innerText = "";
    card.ref.appendChild(cardImg);
  });
}
