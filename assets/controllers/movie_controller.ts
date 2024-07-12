import {Controller} from "@hotwired/stimulus";
import {visit} from '@hotwired/turbo';

export default class extends Controller {

  linkToDetailsPage(event: { params: { url: string; }; }) {
    visit(event.params.url);
  }

}
