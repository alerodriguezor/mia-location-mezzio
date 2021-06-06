import { Injectable } from '@angular/core';
import { MiaCountry } from '../entities/mia_country';
import { MiaBaseCrudHttpService } from '@agencycoda/mia-core';
import { HttpClient } from '@angular/common/http';
import { environment } from 'src/environments/environment';

@Injectable({
  providedIn: 'root'
})
export class MiaCountryService extends MiaBaseCrudHttpService<MiaCountry> {

  constructor(
    protected http: HttpClient
  ) {
    super(http);
    this.basePathUrl = environment.baseUrl + 'mia_country';
  }
 
}