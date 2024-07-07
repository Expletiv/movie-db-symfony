import {Controller} from "@hotwired/stimulus";

export default class extends Controller {

  linkToDetailsPage(event: { params: { url: string; }; }) {
    location.href = event.params.url;
  }

}
